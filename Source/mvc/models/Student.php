<?php

    require_once('config.php');
    class Student {
        public $id;
        public $name;
        public $age;

        public function __construct($id, $name, $age)
        {
            $this->id = $id;
            $this->name = $name;
            $this->age = $age;
        }

        public static function getAll() {
            $sql = "select * from student";
            $conn = DB::getConnection();
            $stm = $conn->query($sql);

            $data = array();
            foreach ($stm->fetchAll() as $item) {
                $data[] = new Student($item['id'], $item['name'], $item['age']);
            }
            return $data;
        }

        public static function get($id) {
            $sql = "select * from student where id = :id";
            $conn = DB::getConnection();
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $id));

            if ($item = $stm->fetch()) {
                return new Student($item['id'], $item['name'], $item['age']);
            }
            return null;
        }

        public static function delete($id) {
            $sql = "delete from student where id = :id";
            $conn = DB::getConnection();
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $id));

            return $stm->rowCount() == 1;
        }

        public static function update($s) {
            $sql = "update student set name = :name, age = :age where id = :id";
            $conn = DB::getConnection();
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $s->id, 'name' => $s->name, 'age' => $s->age));

            return $stm->rowCount() == 1;
        }
    }

?>