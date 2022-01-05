<?php

require_once('config.php');
require_once('function.php');
require_once('Department.php');
require_once('User.php');

class Leave
{
    public $id;
    public $personID;
    public $role;
    public $used_leaves;
    public $total_leaves;


    public function __construct(
        $id,
        $used_leaves,
        $total_leaves,

    ) {
        $this->id = $id;
        $this->used_leaves = $used_leaves;
        $this->total_leaves = $total_leaves;
    }

    public static function get($id)
    {
        $sql = "select * from leave_info where person_id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return new Leave($item['person_id'], $item['used_leaves'], $item['total_leaves']);
        }

        return null;
    }

    public static function getAll()
    {
        $sql = "select * from leave_info";
        $conn = DB::getConnection();
        $stm = $conn->query($sql);

        $data = array();

        foreach ($stm->fetchAll() as $item) {
            $data[] = new Leave($item['person_id'], $item['role'], $item['used_leaves'], $item['total_leaves']);
        }
        return $data;
    }

    public static function getUsedDays($personID)
    {
        $sql = "select used_leaves from leave_info where person_id = :personID";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('personID' => $personID));

        if ($item = $stm->fetch()) {
            return intval($item['used_leaves']);
        }

        return null;
    }
    public static function getAllRequests($leave_id, $role)
    {
        // Lấy hết request từ nhân viên có cũng phòng ban với quản lý
        $sql = "SELECT * FROM leave_record WHERE leave_id in (SELECT id FROM account_info where department = :department and id <> :leave_id) AND status = 'waiting'";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('leave_id' => $leave_id, 'department' => Department::findID($leave_id)));

        if ($role == 3) {
            $sql = "SELECT * FROM leave_record WHERE leave_id in (SELECT id FROM account where role = 2) AND status = 'waiting'";
            $stm = $conn->prepare($sql);
            $stm->execute();
        }

        $data = array();

        foreach ($stm->fetchAll() as $item) {
            $data[] =  array('id' => $item['id'], 'leave_id' => $item['leave_id'], 'description' => $item['description'], 'file_name' => $item['file_name'],  'file' => $item['file'], 'days' => $item['days'], 'date_created' => $item['date_created'], 'date_wanted' => $item['date_wanted'], 'date_response' => $item['date_response'], 'status' => $item['status']);
        }

        return $data;
    }

    public static function getRequest($id, $leave_id, $role)
    {
        // Lấy hết request từ nhân viên có cùng phòng ban với quản lý
        $sql = "SELECT * FROM leave_record WHERE leave_id in (SELECT id FROM account_info where department = :department and id <> :leave_id) AND status = 'waiting' AND id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id, 'leave_id' => $leave_id, 'department' => Department::findID($leave_id)));

        if ($role == 3) {
            $sql = "SELECT * FROM leave_record WHERE leave_id in (SELECT id FROM account where role = 2) AND status = 'waiting' AND id = :id";
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $id));
        }

        if ($item = $stm->fetch()) {
            return array('id' => $item['id'], 'leave_id' => $item['leave_id'], 'description' => $item['description'], 'file_name' => $item['file_name'],  'file' => $item['file'], 'days' => $item['days'], 'date_created' => $item['date_created'], 'date_wanted' => $item['date_wanted'], 'date_response' => $item['date_response'], 'status' => $item['status']);
        }

        return null;
    }

    public static function getRecord($id)
    {
        $sql = "select * from leave_record where leave_id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        $data = array();

        foreach ($stm->fetchAll() as $item) {
            $data[] = array('id' => $item['id'], 'leave_id' => $item['leave_id'], 'description' => $item['description'], 'file' => $item['file'], 'days' => $item['days'], 'date_created' => $item['date_created'], 'date_wanted' => $item['date_wanted'], 'date_response' => $item['date_response'], 'status' => $item['status']);
        }

        return $data;
    }


    public static function checkDate($leave_id)
    {
        /*
            CHECK IF THE NEWEST REQUEST DATE IS LESS THAN 7 DAYS OR NOT
            TRUE IF IT IS ALRIGHT TO CREATE REQUEST
            FALSE IS THE OPPOSITE
        */

        $sql = "SELECT date_response FROM leave_record WHERE leave_id = :leave_id AND status <> 'waiting' ORDER BY id DESC LIMIT 1";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('leave_id' => $leave_id));

        if (!$stm->rowCount() == 1) {
            // IF THERE ISN'T ANY REQUEST YET THEN RETURN FALSE
            return TRUE;
        }

        $dateResponse = $stm->fetch()['date_response'];

        $currentDate = new DateTime($dateResponse, new DateTimeZone('Asia/Ho_Chi_Minh'));
        $today = new DateTime('', new DateTimeZone('Asia/Ho_Chi_Minh'));

        $days_between = calculateDaysBetween($currentDate, $today);

        if ($days_between < 7) {
            return FALSE;
        }
        return TRUE;
    }


    public static function isAvailable($leave_id, $days)
    {
        $sql = "SELECT used_leaves, total_leaves FROM leave_info WHERE person_id = :leave_id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('leave_id' => $leave_id));

        if ($item = $stm->fetch()) {
            $total_leaves = intval($item['total_leaves']);
            $used_leaves = intval($item['used_leaves']);

            if ((intval($days) + $used_leaves) > $total_leaves) {
                return False;
            }
            return True;
        }
    }

    public static function checkWaiting($leave_id)
    {
        /*
            CHECK IF THERE IS ANY ANY REQUEST THAT HAVING A 'waiting' STATUS
            TRUE IF IT IS ALRIGHT TO CREATE REQUEST
            FALSE IS THE OPPOSITE
        */
        $sql = "select * from leave_record where leave_id = :leave_id AND status = 'waiting'";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('leave_id' => $leave_id));

        return !$stm->rowCount() == 1;
    }

    public static function createRequest($leavesRecord)
    {
        $sql = "INSERT INTO leave_record(leave_id, description, file_name, file, days, date_wanted, status) VALUES (:leave_id, :description, :file_name, :file, :days, :date_wanted, :status)";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('leave_id' => $leavesRecord['leave_id'], 'description' => $leavesRecord['description'], 'file_name' => $leavesRecord['file_name'], 'file' => $leavesRecord['file'], 'days' => $leavesRecord['days'], 'date_wanted' => $leavesRecord['date_wanted'], 'status' => "waiting"));

        return $stm->rowCount() == 1;
    }

    public static function acceptRequest($id, $personID, $days)
    {
        $usedDays = Leave::getUsedDays($personID);
        $updateDays = $usedDays + $days;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateResponse = new DateTime();

        $dateResponse = $dateResponse->format('y-m-d H:i:s a');

        // Set status to approved
        $sql1 = "UPDATE leave_record SET status='approved' WHERE id = :id";
        // Update days when approved
        $sql2 = "UPDATE leave_info SET used_leaves = :updateDays WHERE person_id = :personID";
        $sql3 = "UPDATE leave_record SET date_response=:dateResponse WHERE id = :id";

        $conn = DB::getConnection();

        $stm1 = $conn->prepare($sql1);
        $stm1->execute(array('id' => $id));

        $stm2 = $conn->prepare($sql2);
        $stm2->execute(array('updateDays' => $updateDays, 'personID' => $personID));

        $stm3 = $conn->prepare($sql3);
        $stm3->execute(array('dateResponse' => $dateResponse, 'id' => $id));

        return ($stm1->rowCount() == 1) && ($stm2->rowCount() == 1) && ($stm3->rowCount() == 1);
    }

    public static function rejectRequest($id)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateResponse = new DateTime();

        $dateResponse = $dateResponse->format('y-m-d H:i:s a');

        // Set status to refused
        $sql1 = "UPDATE leave_record SET status='refused' WHERE id = :id";
        $sql2 = "UPDATE leave_record SET date_response=:dateResponse WHERE id = :id";

        $conn = DB::getConnection();

        $stm1 = $conn->prepare($sql1);
        $stm1->execute(array('id' => $id));

        $stm2 = $conn->prepare($sql2);
        $stm2->execute(array('dateResponse' => $dateResponse, 'id' => $id));

        return ($stm1->rowCount() == 1) && ($stm2->rowCount() == 1);
    }
}
