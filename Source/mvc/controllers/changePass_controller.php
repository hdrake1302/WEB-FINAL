<?php
    require_once('models/Login.php');
    require_once('login_controller.php');

    class ChangePassController extends LoginController{
        protected $name;
         
        function __construct()
        {
            $this->name = 'changePass';
        }

        public function changePassword(){
            if (!isset($_POST['submit'])){
                die("Submit's error!");
            }

            if(!isset($_POST['newPwd']) || !isset($_POST['confirmPwd'])){
                die("Please input new password and confirmed passoword!");
            }

            $newPwd = $_POST['newPwd'];
            $confirmPwd = $_POST['confirmPwd'];
            
            if(empty($newPwd) || empty($confirmPwd)){
                echo "Can not input empty value
                ";
            }

            if ($newPwd != $confirmPwd){
                die("Wrong password");
            }

            
            
            $result = Login::changePassword($_SESSION['id'], $newPwd);

            $_SESSION['activated'] = 1;
            header("Location: ./index.php");

        }
    }
?>