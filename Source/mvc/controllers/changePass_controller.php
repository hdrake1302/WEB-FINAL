<?php
require_once('models/Login.php');
require_once('login_controller.php');

class ChangePassController extends LoginController
{
    protected $name;

    function __construct()
    {
        $this->name = 'changePass';
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

        if (!password_verify($currentPwd, $_SESSION['password'])) {
            die(json_encode(array('a' => $currentPwd, 'code' => 3, 'message' => 'Sai mật khẩu!')));
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
