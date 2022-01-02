<?php

require_once('config.php');
require_once('function.php');

class User
{
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $avatar;
    public $department; // department id

    public function __construct(
        $id,
        $firstname,
        $lastname,
        $email,
        $phone,
        $avatar,
        $department
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->avatar = $avatar;
        $this->department = $department;
    }

    public static function getAll()
    {
        $sql = "select * from account_info";
        $conn = DB::getConnection();
        $stm = $conn->query($sql);

        $data = array();
        foreach ($stm->fetchAll() as $item) {
            $data[] = new User($item['id'], $item['firstname'], $item['lastname'], $item['email'], $item['phone'], $item['avatar'], $item['department']);
        }
        return $data;
    }

    public static function get($id)
    {
        $sql = "select * from account_info where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return new User($item['id'], $item['firstname'], $item['lastname'], $item['email'], $item['phone'], $item['avatar'], $item['department']);
        }
        return null;
    }


    public static function getDepartmentName($id)
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

    public static function createAccount($data)
    {
        /*
        Function to create a new account for new employees
        This funtion must be only accessed by admin
        Input:
            $data includes ($firstname, $lastname, $email, $phone, $username, $department)
        Output:
            True if create successfully else False
        */

        $sql1 = "INSERT INTO account (username, password, token) 
                            VALUES (:username, :password, :token)";
        // $sql2 = "INSERT INTO account_info (firstname, lastname, email, phone, department) 
        //                     VALUES (:firstname, :lastname, :email, :phone, :department)";

        $conn = DB::getConnection();
        $stm1 = $conn->prepare($sql1);
        // $stm2 = $conn->prepare($sql2);

        $stm1 = $conn->execute(array(
            'username' => $data['username'],
            'password' => $data['username'],
            'token' => generateToken()
        ));

        // $stm2 = $conn->execute(array(
        //     'firstname' => $data['firstname'],
        //     'lastname' => $data['lastname'],
        //     'email' => $data['email'],
        //     'phone' => $data['phone'],
        //     'department' => $data['department']
        // ));

        print_r($stm1);
        die();
        return $stm1->rowCount() == 1;
    }

    public static function getFullName($id)
    {
        $sql = "select firstname, lastname from account_info where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return $item['lastname'] . ' ' . $item['firstname'];
        }
        return null;
    }

    public static function getRole($id)
    {
        $sql = "select role from account where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return $item['role'];
        }
        return null;
    }

    public static function getRoleName($roleID)
    {
        $sql = "select description from role where id = :roleID";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('roleID' => $roleID));

        if ($item = $stm->fetch()) {
            return $item['description'];
        }
        return null;
    }

    public static function getAvatar($id)
    {
        $sql = "select avatar from account_info where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return $item['avatar'];
        }
        return null;
    }

    public static function getToken($id)
    {
        $sql = "select token from account where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return $item['token'];
        }
        return null;
    }

    public static function updateActivated($id)
    {
        $sql = "update account set activated = 0 where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        return $stm->rowCount() == 1;
    }

    public static function updateAvatar($id, $img_path)
    {
        $sql = "update account_info set avatar = :img_path where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id, 'img_path' => $img_path));

        return $stm->rowCount() == 1;
    }
}
