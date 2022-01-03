<?php
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
        // Giao diện quản lý ngày nghỉ phép của nhân viên và trưởng phòng
        if ($_SESSION['role'] == 3) {
            header("Location: ./index.php");
        }

        $leave = Leave::get($_SESSION['id']);
        $leavesRecord = Leave::getRecord($_SESSION['id']);
        $data = array('leave' => $leave, 'leaves_record' => $leavesRecord);
        $this->render('index', $data);
    }

    public function indexRequest()
    {
        // Giao diện quản lý yêu cầu nghỉ phép của Trưởng phòng và Giám đốc
        $id = $_SESSION['id'];
        $role = $_SESSION['role'];

        $leaveRequests = Leave::getAllRequests($id, $role);
        $data = array('leave_requests' => $leaveRequests);
        $this->render('indexRequest', $data);
    }

    public function viewRequest()
    {
        // Giao diện xem chi tiết một yêu cầu
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

        $leaveRequest = Leave::getRequest($id, $_SESSION['id']);
        $data = array('leave_request' => $leaveRequest);
        $this->render('viewRequest', $data);
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

        if (!isDate($_POST['date_wanted'])) {
            // Không phải format của date
            die(json_encode(array('code' => 2, 'message' => 'Invalid format of date_wanted')));
        }

        if (!Leave::checkWaiting($_POST['leave_id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Yêu cầu cũ đang trong trạng thái chờ duyệt')));
        }

        if (!Leave::checkDate($_POST['leave_id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Chưa đủ số ngày đợi để có thể tạo yêu cầu mới')));
        }

        $_POST['file'] = null;
        $_POST['file_name'] = null;

        // HANDLE FILE IF THE USER ATTACH A FILE IN THE REQUEST
        if (isset($_FILES) && !empty($_FILES['file']) && !empty($_FILES['file'])) {
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
            echo json_encode(array('code' => 0, 'message' => 'Tạo yêu cầu nghỉ phép thành công!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Tạo yêu cầu nghỉ phép thất bại!')));
        }
    }

    public function acceptRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['id']) || !isset($_POST['leave_id']) || !isset($_POST['days'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['id']) || empty($_POST['leave_id']) || empty($_POST['days'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        $result = Leave::acceptRequest($_POST['id'], $_POST['leave_id'], $_POST['days']);

        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Chấp nhận yêu cầu nghỉ phép thành công'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Chấp nhận yêu cầu nghỉ phép thất bại!')));
        }
    }

    public function rejectRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['id'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['id'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        $result = Leave::rejectRequest($_POST['id']);

        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Từ chối yêu cầu nghỉ phép thành công'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Từ chối yêu cầu nghỉ phép thất bại!')));
        }
    }
}
