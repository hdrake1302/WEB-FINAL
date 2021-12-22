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
            die(json_encode(array('message' => 'Submit error', 'status' => false)));
        }

        if (!isset($_POST['newPwd']) || !isset($_POST['confirmPwd'])) {
            die(json_encode(array('message' => 'Please input new password and confirm password', 'status' => false)));
        }

        $newPwd = $_POST['newPwd'];
        $confirmPwd = $_POST['confirmPwd'];

        if (empty($newPwd) || empty($confirmPwd)) {
            die(json_encode(array('message' => 'The data is empty', 'status' => false)));
        }

        if ($newPwd != $confirmPwd) {
            die(json_encode(array('message' => 'Both password needs to be exactly the same', 'status' => false)));
        }

        $result = Login::changePassword($_SESSION['id'], $newPwd);

        $_SESSION['activated'] = 1;
        header("Location: ./index.php");
    }
}
