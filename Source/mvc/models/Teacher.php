<?php
    class Teacher {

        public $id;
        public $name;
        public $specialty;

        /**
         * Teacher constructor.
         * @param $id
         * @param $name
         * @param $specialty
         */
        public function __construct($id, $name, $specialty)
        {
            $this->id = $id;
            $this->name = $name;
            $this->specialty = $specialty;
        }

        public static function getAll() {
            $sql = "select * from teacher";
            $conn = DB::getConnection();
            $stm = $conn->query($sql);

            $data = array();
            foreach ($stm->fetchAll() as $item) {
                $data[] = new Teacher($item['id'], $item['name'], $item['specialty']);
            }
            return $data;
        }

        public static function get($id) {
            $sql = "select * from teacher where id = :id";
            $conn = DB::getConnection();
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $id));

            if ($item = $stm->fetch()) {
                return new Teacher($item['id'], $item['name'], $item['specialty']);
            }
            return null;
        }

        public static function delete($id) {
            $sql = "delete from teacher where id = :id";
            $conn = DB::getConnection();
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $id));

            return $stm->rowCount() == 1;
        }

        public static function update($s) {
            $sql = "update teacher set name = :name, specialty = :specialty where id = :id";
            $conn = DB::getConnection();
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $s->id, 'name' => $s->name, 'specialty' => $s->specialty));

            return $stm->rowCount() == 1;
        }


    }
?>
