<?php
// Admin can't access task controller
if ($_SESSION['role'] == 3) {
    header("Location: ./index.php");
}

require_once('models/Task.php');
require_once('base_controller.php');

class TaskController extends BaseController
{

    function __construct()
    {
        $this->name = 'task';
    }

    public function index()
    {

        $tasks = Task::getAll();
        $data = array('tasks' => $tasks);
        $this->render('index', $data);
    }

    public function view()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $user = User::get($id);
        $this->render('view', array('user' => $user));
    }

    public function changePassword()
    {
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
