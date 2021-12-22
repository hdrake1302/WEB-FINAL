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
            die(json_encode(array('message' => 'Submit error', 'status' => false)));
        }

        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            die(json_encode(array('message' => 'Please input username, passoword!', 'status' => false)));
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            die(json_encode(array('message' => 'can not input empty value', 'status' => false)));
        }

        $result = Login::login($username, $password);

        if ($result === null) {
            die(json_encode(array('message' => 'invalid login!', 'status' => false)));
        }

        // SUCCESSFULLY LOGIN
        if ($result !== null) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['role'] = $result['role'];
            $_SESSION['activated'] = $result['activated'];

            $role = $result['role'];
        }

        echo json_encode(array('message' => 'can not input empty value', 'status' => true));

        header("Location: ./index.php");
    }

    public function logout()
    {
        unset($_SESSION['id']);
        session_destroy();
        header("Location: ./index.php");
    }
}
