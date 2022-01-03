<?php

require_once('config.php');
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
        $sql = "SELECT * FROM task WHERE staff_id = :staffID";
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
        $sql = "SELECT * FROM task WHERE staff_id = :staffID AND id = :id";
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

    public static function cancelTask($data)
    {
        print_r($data);
        die();
        $sql = "UPDATE task SET status = 'Canceled' WHERE id = :id";
        $conn = DB::getConnection();

        $stm1 = $conn->prepare($sql);
        $stm1->execute(array('id' => $data['id']));

        $sql = "INSERT INTO task_record(task_id, person_id, status) VALUES (:id, :manager_id, 'Canceled')";

        $stm2 = $conn->prepare($sql);
        $stm2->execute(array('id' => $data['id'], 'manager_id' => $data['manager_id']));

        return $stm1->rowCount() == 1 & $stm2->rowCount() == 1;
    }
}
