<?php
// Admin can't access task controller
if ($_SESSION['role'] == 3) {
    header("Location: ./index.php");
}

require_once('models/Task.php');
require_once('models/User.php');
require_once('base_controller.php');
require_once('function.php');

class TaskController extends BaseController
{

    function __construct()
    {
        $this->name = 'task';
    }

    public function indexManager()
    {
        $tasks = Task::getAll($_SESSION['id']);
        $data = array('tasks' => $tasks);
        $this->render('indexManager', $data);
    }

    public function indexStaff()
    {
        $tasks = Task::getAllAssignedTasks($_SESSION['id']);
        $data = array('tasks' => $tasks);
        $this->render('indexStaff', $data);
    }

    public function viewStaff()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        if ($task = Task::getAssignedTask($id, $_SESSION['id'])) {
            $this->render('viewStaff', array('task' => $task));
        } else {
            header("Location: ./index.php");
        }
    }

    public function viewManager()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $task = Task::get($id, $_SESSION['id']);
        $this->render('viewManager', array('task' => $task));
    }


    public function createTask()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['staff_id']) || !isset($_POST['description']) || !isset($_POST['deadline']) || !isset($_POST['title'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['staff_id']) || empty($_POST['description']) || empty($_POST['deadline']) || empty($_POST['title'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (!isDateTime($_POST['deadline'])) {
            die(json_encode(array('code' => 2, 'message' => 'Invalid format of deadline')));
        }

        if (intval(User::getRole($_POST['staff_id'])) !== 1) {
            die(json_encode(array('code' => 5, 'message' => 'Chỉ có thể giao task cho nhân viên!')));
        }

        $_POST['file'] = null;
        $_POST['file_name'] = null;

        // HANDLE FILE IF THE MANGAER ATTACH A FILE IN THE TASK
        if (isset($_FILES) && !empty($_FILES['file'])) {
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

            $upload_path = "$path\\assets\\uploads\\tasks\\";
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];

            if (file_exists($upload_path . $file_name)) {
                die(json_encode(array('code' => 4, 'message' => "File already exists!")));
            }

            // Name of the file will be hashed before saved
            $file = fileNameHash($file_name) . '.' . $extension;

            $result = move_uploaded_file($file_tmp, $upload_path . $file);
            if ($result) {
                $file_path = URL . "assets/uploads/tasks/" . $file;
                $_POST['file'] = $file_path;
                $_POST['file_name'] = $file_name;
            } else {
                die(json_encode(array('code' => 1, 'message' => "File upload failed!")));
            }
        }


        $_POST['id'] = Task::getNextID();
        $_POST['manager_id'] = $_SESSION['id'];

        $result = Task::createTask($_POST);
        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Tạo task thành công!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Tạo task thất bại!')));
        }
    }

    public function approveTask()
    {
        // Function cho nhân viên start Task
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['id']) || !isset($_POST['rating'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['id']) || empty($_POST['rating'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        $supported_ratings = array("Bad", "OK", "Good");

        if (!in_array($_POST['rating'], $supported_ratings)) {
            die(json_encode(array('code' => 2, 'message' => 'Rating phải là một trong các giá trị "Bad", "OK", "Good"')));
        }


        if (!Task::isAbleToApprove($_POST['id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Task chỉ có thể approve khi đang trong trạng thái Waiting!')));
        }

        if (Task::isLate(Task::getStaffID($_POST['id']), $_POST['id']) && $_POST['rating'] == "Good") {
            die(json_encode(array('code' => 5, 'message' => 'Task đã trễ deadline nên không thể đánh giá mức độ Good!')));
        }

        $_POST['manager_id'] = $_SESSION['id'];

        $result = Task::approveTask($_POST);
        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Approve task successfully!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Approve task unsuccessfully!')));
        }
    }

    public function startTask()
    {
        // Function cho nhân viên start Task
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

        if (Task::isStartedTask($_POST['id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Task đã được chấp nhận trước đó!')));
        }

        $_POST['staff_id'] = $_SESSION['id'];

        $result = Task::startTask($_POST);
        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Chấp nhận task thành công!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Chấp nhận task thất bại!')));
        }
    }

    public function rejectTask()
    {
        // Function cho nhân viên start Task
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['id']) || !isset($_POST['note'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['id']) || empty($_POST['note'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (!Task::isAbleToReject($_POST['id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Task chỉ có thể reject khi đang trong trạng thái Waiting!')));
        }

        $_POST['manager_id'] = $_SESSION['id'];

        $_POST['file'] = null;
        $_POST['file_name'] = null;

        // HANDLE FILE IF THE USER ATTACH A FILE IN THE REQUEST
        if (isset($_FILES) && !empty($_FILES['file'])) {
            $extension = pathinfo($_FILES['file']['name'])['extension'];

            if (!in_array($extension, SUPPORTED_EXTENSIONS)) {
                die(json_encode(array('code' => 2, 'message' => "The file type is not allowed")));
            }

            $file_size = $_FILES['file']['size'];

            if ($file_size >= 500 * 1024 * 1024) {
                die(json_encode(array('code' => 3, 'message' => "file exceeds the maximum allowed size")));
            }

            $path = dirname(dirname(__FILE__));

            $upload_path = "$path\\assets\\uploads\\tasks\\";
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];

            if (file_exists($upload_path . $file_name)) {
                die(json_encode(array('code' => 4, 'message' => "File already exists!")));
            }

            // Name of the file will be hashed before saved
            $file = fileNameHash($file_name) . '.' . $extension;

            $result = move_uploaded_file($file_tmp, $upload_path . $file);
            if ($result) {
                $file_path = URL . "assets/uploads/tasks/" . $file;
                $_POST['file'] = $file_path;
                $_POST['file_name'] = $file_name;
            } else {
                die(json_encode(array('code' => 1, 'message' => "FAILED")));
            }
        }

        $result = Task::rejectTask($_POST);
        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Reject task successfully!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Reject task unsuccessfully!')));
        }
    }
    public function submitTask()
    {
        // Function cho nhân viên SUBMIT Task
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['task_id']) || !isset($_POST['note']) || !isset($_FILES['file'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['task_id']) || empty($_POST['note']) || empty($_FILES['file'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (!Task::isAbleToSubmit($_POST['task_id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Không thể submit vì task không đang trong trạng thái In Progress')));
        }

        // HANDLE FILE IF THE MANGAER ATTACH A FILE IN THE TASK
        $extension = pathinfo($_FILES['file']['name'])['extension'];

        if (!in_array($extension, SUPPORTED_EXTENSIONS)) {
            die(json_encode(array('code' => 2, 'message' => "The file type is not allowed")));
        }

        $file_size = $_FILES['file']['size'];

        if ($file_size >= 500 * 1024 * 1024) {
            die(json_encode(array('code' => 3, 'message' => "file exceeds the maximum allowed size")));
        }

        $path = dirname(dirname(__FILE__));

        $upload_path = "$path\\assets\\uploads\\tasks\\";
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];

        if (file_exists($upload_path . $file_name)) {
            die(json_encode(array('code' => 4, 'message' => "File already exists!")));
        }

        // Name of the file will be hashed before saved
        $file = fileNameHash($file_name) . '.' . $extension;

        $result = move_uploaded_file($file_tmp, $upload_path . $file);
        if ($result) {
            $file_path = URL . "assets/uploads/tasks/" . $file;
            $_POST['file'] = $file_path;
            $_POST['file_name'] = $file_name;
        } else {
            die(json_encode(array('code' => 1, 'message' => "File upload failed!")));
        }

        $_POST['staff_id'] = $_SESSION['id'];
        $result = Task::submitTask($_POST);
        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Submit task thành công!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Submit task thất bại!')));
        }
    }

    public function indexHistory()
    {
        $taskID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $history = Task::getAllHistory($taskID);
        $this->render('indexHistory', array('history' => $history));
    }

    public function viewHistory()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $history = Task::getHistory($id);
        $this->render('viewHistory', array('history' => $history));
    }

    public function cancelTask()
    {
        // Function cho nhân viên start Task
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

        if (!Task::isNewTask($_POST['id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Task này không thể bị hủy!')));
        }

        $_POST['manager_id'] = $_SESSION['id'];

        $result = Task::cancelTask($_POST);
        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Hủy task thành công!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Hủy task thất bại!')));
        }
    }
}
