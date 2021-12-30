<?php
// Admin can't access task controller
if ($_SESSION['role'] == 3) {
    header("Location: ./index.php");
}
require_once('models/Leave.php');
require_once('base_controller.php');
require_once('function.php');

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

        if (!isset($_POST['leave_id']) || !isset($_POST['description']) || !isset($_POST['days']) || !isset($_POST['date_wanted'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['leave_id']) || empty($_POST['description']) || empty($_POST['days']) || empty($_POST['date_wanted'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (!Leave::checkWaiting($_POST['leave_id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Yêu cầu cũ đang trong trạng thái chờ duyệt')));
        }

        if (!Leave::checkDate($_POST['leave_id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Chưa đủ số ngày đợi để có thể tạo yêu cầu mới')));
        }

        // HANDLE FILE IF THE USER ATTACH A FILE IN THE REQUEST
        if (isset($_FILES)) {
            $supported_extensions = array("jpg", "png", "docx", "pdf");

            $extension = pathinfo($_FILES['file']['name'])['extension'];

            if (!in_array($extension, $supported_extensions)) {
                die(json_encode(array('code' => 2, 'message' => "The file type is not allowed")));
            }

            $file_size = $_FILES['file']['size'];

            if ($file_size >= 500 * 1024 * 1024) {
                die(json_encode(array('code' => 3, 'message' => "file exceeds the maximum allowed size")));
            }

            $path = dirname(dirname(__FILE__));

            $upload_path = "$path\\assets\\uploads\\leaves\\";
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];

            if (file_exists($upload_path . $file_name)) {
                die(json_encode(array('code' => 4, 'message' => "File already exists!")));
            }

            // Name of the file will be hashed before saved
            $file = fileNameHash($file_name) . '.' . $extension;

            $result = move_uploaded_file($file_tmp, $upload_path . $file);
            if ($result) {
                $file_path = URL . "assets/uploads/leaves/" . $file;
                $_POST['file'] = $file_path;
                $_POST['file_name'] = $file_name;
            } else {
                die(json_encode(array('code' => 1, 'message' => "FAILED")));
            }
        }

        $result = Leave::createRequest($_POST);
        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'CREATE REQUEST SUCCESSFULLY'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'FAILED!')));
        }
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
