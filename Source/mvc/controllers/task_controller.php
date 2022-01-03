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
        $task = Task::getAssignedTask($id, $_SESSION['id']);
        $this->render('viewStaff', array('task' => $task));
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

    public static function startTask()
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
            die(json_encode(array('code' => 3, 'message' => 'TChấp nhận task thất bại!')));
        }
    }

    public static function cancelTask()
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

        if (Task::isNewTask($_POST['id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Task đã được chấp nhận nên không thể hủy!')));
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
