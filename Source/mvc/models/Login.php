<?php
class Login
{
    public $id;
    public $username;
    public $password;

    public function __construct($id, $username, $password)
    {
        $this->$id = $id;
        $this->$username = $username;
        $this->$password = $password;
    }

    public static function login($username, $password)
    {
        $sql = "select * from account where username = :username";
        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('username' => $username));

        if ($item = $stm->fetch()) {
            $verify = password_verify($password, $item['password']);
        } else {
            return null;
        }

        if ($verify) {
            $sql = "select firstname, lastname, avatar from account_info where id = :id";
            $stm = $conn->prepare($sql);
            $stm->execute(array('id' => $item['id']));

            $item = array_merge($item, $stm->fetch());
            return $item;
        }

        return null;
    }
    public static function changePassword($id, $newPassword)
    {
        $pwd_hashed = password_hash($newPassword, PASSWORD_BCRYPT);

        $sql = "UPDATE account SET password = :pwd_hashed, activated = 1 WHERE id = :id";

        $conn = DB::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute(array('id' => $id, 'pwd_hashed' => $pwd_hashed));

        return True;
    }
}
