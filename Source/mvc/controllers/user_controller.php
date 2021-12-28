<?php
require_once('models/User.php');
require_once('base_controller.php');

class UserController extends BaseController
{

    function __construct()
    {
        $this->name = 'user';
    }

    public function index()
    {

        $users = User::getAll();
        $data = array('users' => $users);
        $this->render('index', $data);
    }

    public function view()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $user = User::get($id);
        $this->render('view', array('user' => $user));
    }

    public function viewProfile()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

        // ONLY LET USER TO VIEW THEIR OWN PROFILE
        if ($_SESSION['id'] !== $id) {
            header("Location: ./index.php");
        }

        $user = User::get($id);
        $this->render('viewProfile', array('user' => $user));
    }

    public function confirmChange()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

        // ONLY LET USER TO VIEW THEIR OWN PROFILE
        if ($_SESSION['id'] !== $id) {
            header("Location: ./index.php");
        }

        $_SESSION['activated'] = 0;
        $user = User::updateActivated($id);
        header("Location: ./index.php?controller=changePass&action=view");
    }

    public function edit()
    {
        echo 'Edit page of Student';
    }

    public function save()
    {
        echo 'Save page of Student';
    }

    public function delete()
    {
        echo 'Delete page of Student';
    }
}
