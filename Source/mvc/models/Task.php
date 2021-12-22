<?php

require_once('config.php');
class Task
{
    public $id;
    public $managerIDID;
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

    public static function getAll()
    {
        $sql = "select * from task";
        $conn = DB::getConnection();
        $stm = $conn->query($sql);

        $data = array();
        foreach ($stm->fetchAll() as $item) {
            $data[] = new Task($item['id'], $item['managerID'], $item['staffID'], $item['title'], $item['description'], $item['status'], $item['rating'], $item['date'], $item['deadline']);
        }
        return $data;
    }
}
