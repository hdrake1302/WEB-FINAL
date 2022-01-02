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
            if ($item['avatar'] === null) {
                // Nếu chưa set avatar thì để avatar mặc định
                $src = "https://www.nj.com/resizer/zovGSasCaR41h_yUGYHXbVTQW2A=/1280x0/smart/cloudfront-us-east-1.images.arcpublishing.com/advancelocal/SJGKVE5UNVESVCW7BBOHKQCZVE.jpg";
                $item['avatar'] = $src;
            }
            return new User($item['id'], $item['firstname'], $item['lastname'], $item['email'], $item['phone'], $item['avatar'], $item['department']);
        }
        return null;
    }

    public static function getUsername($id)
    {
        $sql = "select username from account where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return $item['username'];
        }
        return null;
    }

    public static function getActivated($id)
    {
        $sql = "select activated from account where id = :id";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id));

        if ($item = $stm->fetch()) {
            return $item['activated'];
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

    public static function getNextID()
    {
        $sql = "SELECT id FROM account ORDER BY id DESC LIMIT 1";
        $conn = DB::getConnection();
        $stm = $conn->query($sql);

        if ($item = $stm->fetch()) {
            return intval($item['id']) + 1;
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

    public static function checkUsername($username)
    {
        $sql = "SELECT username FROM account";
        $conn = DB::getConnection();
        $stm = $conn->query($sql);

        foreach ($stm->fetchAll() as $item) {
            if ($username == $item['username']) {
                return False;
            }
        }
        return True;
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

        $sql = "INSERT INTO account (id, username, password, token) 
                            VALUES (:id, :username, :password, :token)";

        $conn = DB::getConnection();
        $stm1 = $conn->prepare($sql);
        $stm1->execute(array(
            'id' => $data['id'],
            'username' => $data['username'],
            'password' => password_hash($data['username'], PASSWORD_BCRYPT),
            'token' => generateToken()
        ));

        $sql = "INSERT INTO account_info (id, firstname, lastname, email, phone, department) VALUES (:id, :firstname, :lastname, :email, :phone, :department)";
        $conn = DB::getConnection();

        $stm2 = $conn->prepare($sql);
        $stm2->execute(array(
            'id' => $data['id'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'department' => $data['department']
        ));

        $sql = "INSERT INTO leave_info (person_id) VALUES (:id)";
        $conn = DB::getConnection();

        $stm3 = $conn->prepare($sql);
        $stm3->execute(array(
            'id' => $data['id']
        ));
        return ($stm1->rowCount() == 1)  && ($stm2->rowCount() == 1) && ($stm3->rowCount() == 1);
    }
}
