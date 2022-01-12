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
        $description
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

    public static function createDepartmentInfo($data)
    {
        $sql = "INSERT INTO department_info (id, description, roomQuantity) VALUES (:id, :description, :roomQuantity)";

        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $data['id'],  'description' => $data['description'], 'roomQuantity' => $data['roomQuantity']));

        return $stm->rowCount() == 1;
    }

    public static function editDepartmentInfo($data)
    {
        $sql = "UPDATE department_info SET description = :description, roomQuantity = :roomQuantity WHERE id = :id";

        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        if ($stm->execute(array('id' => $data['id'],  'description' => $data['description'], 'roomQuantity' => $data['roomQuantity']))) {
            return True;
        }
        return False;
    }

    public static function appointManager($id, $userID)
    {
        $sql = "UPDATE department_info SET managerID = :userID WHERE id = :id";

        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);

        if ($stm->execute(array('id' => $id, 'userID' => $userID))) {
            return True;
        }

        return False;
    }

    public static function existManager($id)
    {
        $sql = "SELECT * FROM department_info WHERE id = :id AND managerID <> 'NULL'";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($stm->fetch()) {
            return True;
        }
        return False;
    }

    public static function getManagerID($id)
    {
        $sql = "select managerID from department_info where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return intval($item['managerID']);
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

    public static function getNextID()
    {
        $sql = "SELECT id from department ORDER BY id DESC LIMIT 1";
        $conn = DB::getConnection();
        $stm = $conn->query($sql);

        if ($item = $stm->fetch()) {
            return intval($item['id']) + 1;
        }

        return 1;
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

    public static function getManagerID($id)
    {
        return DepartmentInfo::getManagerID($id);
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

    public static function createDepartment($data)
    {
        $sql = "INSERT INTO department VALUES(:id, :name)";

        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $data['id'], 'name' => $data['name']));

        $result = DepartmentInfo::createDepartmentInfo($data);

        return $stm->rowCount() == 1 && $result;
    }

    public static function editDepartment($data)
    {
        $sql = "UPDATE department SET name = :name WHERE id = :id";

        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);

        $result = DepartmentInfo::editDepartmentInfo($data);
        if ($result && $stm->execute(array('id' => $data['id'], 'name' => $data['name']))) {
            return True;
        }

        return False;
    }

    public static function appointManager($id, $userID)
    {

        return DepartmentInfo::appointManager($id, $userID);
    }

    public static function existManager($id)
    {
        return DepartmentInfo::existManager($id);
    }
}
