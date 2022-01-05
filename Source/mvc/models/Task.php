<?php

require_once('config.php');
require_once('function.php');

class TaskRecord
{

    public $id;
    public $task_id;
    public $person_id;
    public $status;
    public $note;
    public $file_name;
    public $file;
    public $date;

    public function __construct(
        $id,
        $task_id,
        $person_id,
        $status,
        $note,
        $file_name,
        $file,
        $date
    ) {
        $this->id = $id;
        $this->task_id = $task_id;
        $this->person_id = $person_id;
        $this->status = $status;
        $this->note = $note;
        $this->file_name = $file_name;
        $this->file = $file;
        $this->date = $date;
    }

    public static function getAll($taskID)
    {
        // Lấy hết tất cả các task đã được tạo bởi Trưởng phòng
        $sql = "SELECT * FROM task_record WHERE task_id = :taskID";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('taskID' => $taskID));

        $data = array();
        foreach ($stm->fetchAll() as $item) {
            $data[] = new TaskRecord($item['id'], $item['task_id'], $item['person_id'], $item['status'], $item['note'], $item['file_name'], $item['file'], $item['date']);
        }
        return $data;
    }

    public static function get($id)
    {
        // Lấy hết tất cả các task đã được tạo bởi Trưởng phòng
        $sql = "SELECT * FROM task_record WHERE id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return new TaskRecord($item['id'], $item['task_id'], $item['person_id'], $item['status'], $item['note'], $item['file_name'], $item['file'], $item['date']);
        }
        return null;
    }

    public static function getLatestSubmit($taskID)
    {
        // Lấy task user submit mới nhất
        $sql = "SELECT * FROM task_record WHERE task_id = :taskID AND status = 'Waiting' ORDER BY id DESC LIMIT 1";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('taskID' => $taskID));

        if ($item = $stm->fetch()) {
            return new TaskRecord($item['id'], $item['task_id'], $item['person_id'], $item['status'], $item['note'], $item['file_name'], $item['file'], $item['date']);
        }
        return null;
    }

    public static function getLatestRejected($taskID)
    {
        // Lấy task user submit mới nhất
        $sql = "SELECT * FROM task_record WHERE task_id = :taskID AND status = 'Rejected' ORDER BY id DESC LIMIT 1";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('taskID' => $taskID));

        if ($item = $stm->fetch()) {
            return new TaskRecord($item['id'], $item['task_id'], $item['person_id'], $item['status'], $item['note'], $item['file_name'], $item['file'], $item['date']);
        }
        return null;
    }

    public static function isLate($deadline, $staffID, $taskID)
    {
        // Lấy hết tất cả các task đã được assign cho NV
        $sql = "SELECT date FROM task_record WHERE person_id = :person_id AND task_id = :task_id ORDER BY id DESC LIMIT 1";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('task_id' => $taskID, 'person_id' => $staffID));

        $date = $stm->fetch()['date'];
        $currentDate = new DateTime($date, new DateTimeZone('Asia/Ho_Chi_Minh'));
        $laterDate = new DateTime($deadline, new DateTimeZone('Asia/Ho_Chi_Minh'));

        $seconds_between = calculateSecondsBetween($currentDate, $laterDate);
        if ($seconds_between < 0) {
            return True;
        }
        return False;
    }
}

class Task
{
    public $id;
    public $managerID;
    public $staffID;
    public $title;
    public $description;
    public $status;
    public $rating;
    public $date;
    public $deadline;

    public function __construct(
        $id,
        $managerID,
        $staffID,
        $title,
        $description,
        $status,
        $rating,
        $date,
        $deadline,
    ) {
        $this->id = $id;
        $this->managerID = $managerID;
        $this->staffID = $staffID;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->rating = $rating;
        $this->date = $date;
        $this->deadline = $deadline;
    }

    public static function getAll($managerID)
    {
        // Lấy hết tất cả các task đã được tạo bởi Trưởng phòng
        $sql = "SELECT * FROM task WHERE manager_id = :managerID";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('managerID' => $managerID));

        $data = array();
        foreach ($stm->fetchAll() as $item) {
            $data[] = new Task($item['id'], $item['manager_id'], $item['staff_id'], $item['title'], $item['description'], $item['status'], $item['rating'], $item['date_created'], $item['deadline']);
        }
        return $data;
    }

    public static function get($id, $managerID)
    {
        // Lấy hết tất cả các task đã được assign cho NV
        $sql = "SELECT * FROM task WHERE manager_id = :managerID AND id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id, 'managerID' => $managerID));

        if ($item = $stm->fetch()) {
            return new Task($item['id'], $item['manager_id'], $item['staff_id'], $item['title'], $item['description'], $item['status'], $item['rating'], $item['date_created'], $item['deadline']);
        }

        return null;
    }

    public static function getAllAssignedTasks($staffID)
    {
        // Lấy hết tất cả các task đã được assign cho NV
        $sql = "SELECT * FROM task WHERE staff_id = :staffID AND status <> 'Canceled'";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('staffID' => $staffID));

        $data = array();
        foreach ($stm->fetchAll() as $item) {
            $data[] = new Task($item['id'], $item['manager_id'], $item['staff_id'], $item['title'], $item['description'], $item['status'], $item['rating'], $item['date_created'], $item['deadline']);
        }
        return $data;
    }

    public static function getAssignedTask($id, $staffID)
    {
        // Lấy hết tất cả các task đã được assign cho NV
        $sql = "SELECT * FROM task WHERE staff_id = :staffID AND id = :id AND status <> 'Canceled'";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id, 'staffID' => $staffID));

        if ($item = $stm->fetch()) {
            return new Task($item['id'], $item['manager_id'], $item['staff_id'], $item['title'], $item['description'], $item['status'], $item['rating'], $item['date_created'], $item['deadline']);
        }

        return null;
    }

    public static function getNextID()
    {
        $sql = "SELECT id FROM task ORDER BY id DESC LIMIT 1";
        $conn = DB::getConnection();
        $stm = $conn->query($sql);

        if ($item = $stm->fetch()) {
            return intval($item['id']) + 1;
        }
        return 1;
    }

    public static function getStaffID($taskID)
    {
        $sql = "SELECT staff_id FROM task WHERE id = :task_id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('task_id' => $taskID));

        if ($item = $stm->fetch()) {
            return $item['staff_id'];
        }
        return null;
    }

    public static function getFile($taskID)
    {
        $sql = "SELECT file_name, file FROM task_record WHERE task_id = :taskID AND status='new'";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('taskID' => $taskID));

        if ($item = $stm->fetch()) {
            return $item;
        }
        return null;
    }

    public static function getRating($taskID)
    {
        $sql = "SELECT rating FROM task WHERE id = :taskID AND status='Completed'";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('taskID' => $taskID));

        if ($item = $stm->fetch()) {
            return $item['rating'];
        }
        return null;
    }

    public static function createTask($data)
    {
        $sql = "INSERT INTO task(id, manager_id, description, staff_id, title, deadline) VALUES (:id, :manager_id, :description, :staff_id, :title, :deadline)";
        $conn = DB::getConnection();

        $stm1 = $conn->prepare($sql);
        $stm1->execute(array('id' => $data['id'], 'manager_id' => $data['manager_id'], 'description' => $data['description'], 'staff_id' => $data['staff_id'], 'title' => $data['title'], 'deadline' => $data['deadline']));

        $sql = "INSERT INTO task_record(task_id, person_id, file_name, file) VALUES (:id, :manager_id, :file_name, :file)";

        $stm2 = $conn->prepare($sql);
        $stm2->execute(array('id' => $data['id'], 'manager_id' => $data['manager_id'], 'file_name' => $data['file_name'], 'file' => $data['file']));

        return $stm1->rowCount() == 1 & $stm2->rowCount() == 1;
    }

    public static function approveTask($data)
    {
        $sql = "UPDATE task SET rating = :rating, status = 'Completed' WHERE id = :id";
        $conn = DB::getConnection();

        $stm1 = $conn->prepare($sql);
        $stm1->execute(array('id' => $data['id'], 'rating' => $data['rating']));

        $sql = "INSERT INTO task_record(task_id, person_id, status) VALUES (:id, :manager_id, 'Completed')";

        $stm2 = $conn->prepare($sql);
        $stm2->execute(array('id' => $data['id'], 'manager_id' => $data['manager_id']));

        return $stm1->rowCount() == 1 & $stm2->rowCount() == 1;
    }

    public static function rejectTask($data)
    {
        $sql = "UPDATE task SET status = 'Rejected' WHERE id = :id";
        $conn = DB::getConnection();

        $stm1 = $conn->prepare($sql);
        $stm1->execute(array('id' => $data['id']));

        $sql = "INSERT INTO task_record(task_id, person_id, note, file_name, file, status) VALUES (:id, :manager_id, :note, :file_name, :file, 'Rejected')";

        $stm2 = $conn->prepare($sql);
        $stm2->execute(array('id' => $data['id'], 'manager_id' => $data['manager_id'], 'note' => $data['note'], 'file_name' => $data['file_name'], 'file' => $data['file']));

        return $stm1->rowCount() == 1 & $stm2->rowCount() == 1;
    }

    public static function isNewTask($taskID)
    {
        $sql = "SELECT status FROM task WHERE id = :task_id AND status = 'New'";
        $conn = DB::getConnection();

        $stm = $conn->prepare($sql);
        $stm->execute(array('task_id' => $taskID));

        if ($item = $stm->fetch()) {
            return True;
        }
        return False;
    }

    public static function isStartedTask($taskID)
    {
        $sql = "SELECT status FROM task WHERE id = :task_id AND status = 'In progress'";
        $conn = DB::getConnection();

        $stm = $conn->prepare($sql);
        $stm->execute(array('task_id' => $taskID));

        if ($item = $stm->fetch()) {
            return True;
        }
        return False;
    }

    public static function isLate($staffID, $taskID)
    {
        // Lấy hết tất cả các task đã được assign cho NV
        $sql = "SELECT deadline FROM task WHERE id = :task_id AND status <> 'Canceled'";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('task_id' => $taskID));

        $deadline = $stm->fetch()['deadline'];
        return TaskRecord::isLate($deadline, $staffID, $taskID);
    }

    public static function startTask($data)
    {
        $sql = "UPDATE task SET status = 'In progress' WHERE id = :id";
        $conn = DB::getConnection();

        $stm1 = $conn->prepare($sql);
        $stm1->execute(array('id' => $data['id']));

        $sql = "INSERT INTO task_record(task_id, person_id, status) VALUES (:id, :staff_id, 'In progress')";

        $stm2 = $conn->prepare($sql);
        $stm2->execute(array('id' => $data['id'], 'staff_id' => $data['staff_id']));

        return $stm1->rowCount() == 1 & $stm2->rowCount() == 1;
    }

    public static function isAbleToSubmit($taskID)
    {
        $sql = "SELECT status FROM task WHERE id = :task_id AND status = 'In Progress' OR status = 'Rejected'";
        $conn = DB::getConnection();

        $stm = $conn->prepare($sql);
        $stm->execute(array('task_id' => $taskID));

        if ($item = $stm->fetch()) {
            return True;
        }
        return False;
    }

    public static function isAbleToApprove($taskID)
    {
        $sql = "SELECT status FROM task WHERE id = :task_id AND status = 'Waiting'";
        $conn = DB::getConnection();

        $stm = $conn->prepare($sql);
        $stm->execute(array('task_id' => $taskID));

        if ($item = $stm->fetch()) {
            return True;
        }
        return False;
    }
    public static function isAbleToReject($taskID)
    {
        $sql = "SELECT status FROM task WHERE id = :task_id AND status = 'Waiting'";
        $conn = DB::getConnection();

        $stm = $conn->prepare($sql);
        $stm->execute(array('task_id' => $taskID));

        if ($item = $stm->fetch()) {
            return True;
        }
        return False;
    }

    public static function submitTask($data)
    {
        $sql = "UPDATE task SET status = 'Waiting' WHERE id = :task_id";
        $conn = DB::getConnection();

        $stm1 = $conn->prepare($sql);
        $stm1->execute(array('task_id' => $data['task_id']));

        $sql = "INSERT INTO task_record(task_id, person_id, note, file_name, file, status) VALUES (:task_id, :staff_id, :note, :file_name, :file, 'Waiting')";

        $stm2 = $conn->prepare($sql);
        $stm2->execute(array('task_id' => $data['task_id'], 'staff_id' => $data['staff_id'], 'note' => $data['note'], 'file_name' => $data['file_name'], 'file' => $data['file']));

        return $stm1->rowCount() == 1 & $stm2->rowCount() == 1;
    }

    public static function cancelTask($data)
    {
        $sql = "UPDATE task SET status = 'Canceled' WHERE id = :id";
        $conn = DB::getConnection();

        $stm1 = $conn->prepare($sql);
        $stm1->execute(array('id' => $data['id']));

        $sql = "INSERT INTO task_record(task_id, person_id, status) VALUES (:id, :manager_id, 'Canceled')";

        $stm2 = $conn->prepare($sql);
        $stm2->execute(array('id' => $data['id'], 'manager_id' => $data['manager_id']));

        return $stm1->rowCount() == 1 & $stm2->rowCount() == 1;
    }

    public static function getAllHistory($taskID)
    {
        return TaskRecord::getAll($taskID);
    }

    public static function getHistory($taskID)
    {
        return TaskRecord::get($taskID);
    }

    public static function getSubmit($taskID)
    {
        return TaskRecord::getLatestSubmit($taskID);
    }

    public static function getRejectedDetail($taskID)
    {
        return TaskRecord::getLatestRejected($taskID);
    }
}
