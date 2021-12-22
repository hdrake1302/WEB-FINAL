<?php
// If user already login then head back to index
if (isset($_SESSION['id']) && $_SESSION['activated'] != 0) {
    header("Location: ./index.php");
}
require_once('models/Login.php');

class LoginController
{
    protected $name;

    function __construct()
    {
        $this->name = 'login';
    }

    public function view()
    {
        require_once('views/login/' . $this->name . '.php');
    }

    public function login()
    {
        if (!isset($_POST['submit'])) {
            die("Submit's error!");
        }

        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            die("Please input username, passoword!");
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            echo "can not input empty value
                ";
        }

        $result = Login::login($username, $password);

        // SUCCESSFULLY LOGIN
        if ($result !== null) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['role'] = $result['role'];
            $_SESSION['activated'] = $result['activated'];

            $role = $result['role'];
        }
        header("Location: ./index.php");
    }

    public function logout()
    {
        unset($_SESSION['id']);
        session_destroy();
        header("Location: ./index.php");
    }
}
