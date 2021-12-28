<?php
// If user already login then head back to index
if (isset($_SESSION['id']) && $_SESSION['activated'] != 0) {
    header("Location: ./index.php");
}
require_once('models/Login.php');
require_once('user_controller.php');

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
            die(json_encode(array('code' => 5, 'message' => 'Submit Error')));
        }

        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        $result = Login::login($username, $password);

        if ($result === null) {
            die(json_encode(array('code' => 3, 'message' => 'Sai tên đăng nhập hoặc mật khẩu!')));
        }

        // SUCCESSFULLY LOGIN, SAVE NECCESSARY INFORMATION TO SESSION
        $_SESSION['id'] = $result['id'];
        $_SESSION['password'] = $result['password'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['activated'] = $result['activated'];

        $_SESSION['fullname'] = $result['lastname'] . ' ' . $result['firstname'];
        $_SESSION['avatar'] = $result['avatar'];
        header("Location: ./index.php");
    }

    public function logout()
    {
        unset($_SESSION['id']);
        session_destroy();
        header("Location: ./index.php");
    }
}
