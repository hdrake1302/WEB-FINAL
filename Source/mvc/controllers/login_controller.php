<?php
require_once('models/Login.php');
require_once('user_controller.php');
require_once('function.php');

class LoginController
{
    function __construct()
    {
        $this->name = 'login';
    }

    public function view()
    {
        // If user already login then head back to index
        if (isset($_SESSION['id'])) {
            header("Location: ./index.php");
        }
        require_once('views/login/login.php');
    }

    public function viewChangePassword()
    {
        // If user already login then head back to index
        if (isset($_SESSION['id']) && $_SESSION['activated'] != 0) {
            header("Location: ./index.php");
        }
        require_once('views/login/changePassword.php');
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

    public function changePassword()
    {
        if (!isset($_POST['submit'])) {
            die(json_encode(array('code' => 5, 'message' => 'Submit error')));
        }

        if (!isset($_POST['currentPwd']) || !isset($_POST['newPwd']) || !isset($_POST['confirmPwd'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        $currentPwd = $_POST['currentPwd'];
        $newPwd = $_POST['newPwd'];
        $confirmPwd = $_POST['confirmPwd'];

        if (empty($currentPwd) || empty($newPwd) || empty($confirmPwd)) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if ($currentPwd === $newPwd) {
            die(json_encode(array('code' => 2, 'message' => 'Mật khẩu hiện tại không được trùng với mật khẩu mới')));
        }

        if ($newPwd !== $confirmPwd) {
            die(json_encode(array('code' => 2, 'message' => 'Mật khẩu mới và mật khẩu xác nhận với giống nhau')));
        }

        if (!password_verify($currentPwd, $_SESSION['password'])) {
            die(json_encode(array('code' => 3, 'message' => 'Sai mật khẩu!')));
        }

        if ($newPwd != $confirmPwd) {
            die(json_encode(array('code' => 2, 'message' => 'Mật khẩu cần phải giống nhau')));
        }

        $result = Login::changePassword($_SESSION['id'], $newPwd);

        $_SESSION['activated'] = 1;
        $_SESSION['password'] = password_hash($newPwd, PASSWORD_BCRYPT);
        header("Location: ./index.php");
    }
}
