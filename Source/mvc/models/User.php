<?php

    require_once('config.php');
    class User {
        public $id;
        public $firstname;
        public $lastname;
        public $email;
        public $phone;
        public $avatar;
        public $department; // department id

        public function __construct($id ,$firstname, $lastname,
         $email, $phone, $avatar, $department)
        {
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->phone = $phone;
            $this->avatar = $avatar;
            $this->department = $department;
        }

        public static function getAll() {
            $sql = "select * from account_info";
            $conn = DB::getConnection();
            $stm = $conn->query($sql);

            $data = array();
            foreach ($stm->fetchAll() as $item) {
                $data[] = new User($item['id'], $item['firstname'], $item['lastname'], $item['email'], $item['phone'], $item['avatar'], $item['department']);
            }
            return $data;
        }

        public static function get($id) {
            $sql = "select * from account_info where id = :id";
            $conn = DB::getConnection();
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $id));

            if ($item = $stm->fetch()) {
                return new User($item['id'], $item['firstname'], $item['lastname'], $item['email'], $item['phone'], $item['avatar'], $item['department']);
            }
            return null;
        }

        public static function delete($id) {
            $sql = "delete from account_info where id = :id";
            $conn = DB::getConnection();
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $id));

            return $stm->rowCount() == 1;
        }

        public static function update($s) {
            $sql = "update account_info set name = :name, age = :age where id = :id";
            $conn = DB::getConnection();
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $s->id, 'name' => $s->name, 'age' => $s->age));

            return $stm->rowCount() == 1;
        }
    }

?>