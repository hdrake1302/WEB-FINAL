<?php

require_once('config.php');
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
}
