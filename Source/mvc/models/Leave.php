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
        $personID,
        $role,
        $used_leaves,
        $total_leaves,

    ) {
        $this->id = $id;
        $this->personID = $personID;
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
            $data[] = new Leave($item['id'], $item['personID'], $item['role'], $item['used_leaves'], $item['total_leaves']);
        }
        return $data;
    }
}
