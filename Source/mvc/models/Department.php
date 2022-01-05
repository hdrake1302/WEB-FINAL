<?php

require_once('config.php');

class DepartmentInfo
{
    public $id;
    public $roomQuantity;
    public $description;
    public $managerID;

    public function __construct(
        $id,
        $roomQuantity,
        $managerID,
        $description,
    ) {
        $this->id = $id;
        $this->roomQuantity = $roomQuantity;
        $this->description = $description;
        $this->managerID = $managerID;
    }

    public static function get($id)
    {
        $sql = "SELECT * FROM department_info WHERE id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return new DepartmentInfo($item['id'], $item['roomQuantity'], $item['managerID'], $item['description']);
        }
        return null;
    }
}

class Department
{
    public $id;
    public $name;

    public function __construct(
        $id,
        $name,
    ) {
        $this->id = $id;
        $this->name = $name;
    }



    public static function findID($id)
    {
        $sql = "select id from department_info where managerID = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return $item['id'];
        }
        return null;
    }

    public static function getAll()
    {
        $sql = "select * from department";
        $conn = DB::getConnection();
        $stm = $conn->query($sql);

        $data = array();
        foreach ($stm->fetchAll() as $item) {
            $data[] = new Department($item['id'], $item['name']);
        }
        return $data;
    }

    public static function getDetail($id)
    {
        return DepartmentInfo::get($id);
    }

    public static function getName($id)
    {
        $sql = "select name from department where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return $item['name'];
        }
        return null;
    }

    public static function checkDepartment($id)
    {
        $sql = "select * from department where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return True;
        }
        return False;
    }
}
