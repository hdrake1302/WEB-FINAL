<?php

require_once('config.php');
class Leave
{
    public $id;
    public $personID;
    public $role;
    public $used_leaves;
    public $total_leaves;


    public function __construct(
        $id,
        $role,
        $used_leaves,
        $total_leaves,

    ) {
        $this->id = $id;
        $this->role = $role;
        $this->used_leaves = $used_leaves;
        $this->total_leaves = $total_leaves;
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

    public static function getRecord($id)
    {
        $sql = "select * from leave_record where leave_id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        $data = array();

        foreach ($stm->fetchAll() as $item) {
            $data[] = array('id' => $item['id'], 'leave_id' => $item['leave_id'], 'description' => $item['description'], 'file' => $item['file'], 'days' => $item['days'], 'date_created' => $item['date_created'], 'date_wanted' => $item['date_wanted'], 'status' => $item['status']);
        }

        return $data;
    }

    public static function createRequest($leavesRecord)
    {
        $sql = "INSERT INTO leaves_record(leave_id, description, file, days, date_wanted, status) VALUES (:leave_id, :description, :file, :days, :date_wanted, :status)";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('leave_id' => $leavesRecord['leave_id'], 'description' => $leavesRecord['description'], 'file' => $leavesRecord['file'], 'days' => $leavesRecord['days'], 'date_wanted' => $leavesRecord['date_wanted'], 'status' => "waiting"));

        return $stm->rowCount() == 1;
    }
}
