<?php
// Admin can't access task controller
if ($_SESSION['role'] == 3) {
    header("Location: ./index.php");
}
require_once('models/Leave.php');
require_once('base_controller.php');

class LeaveController extends BaseController
{

    function __construct()
    {
        $this->name = 'leave';
    }

    public function index()
    {

        $leaves = Leave::getAll();
        $leavesRecord = Leave::getRecord($_SESSION['id']);
        $data = array('leaves' => $leaves, 'leaves_record' => $leavesRecord);
        $this->render('index', $data);
    }

    public function view()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $user = User::get($id);
        $this->render('view', array('user' => $user));
    }

    public function createRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        print_r($_POST);
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
