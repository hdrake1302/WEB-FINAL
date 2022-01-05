
<?php
if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
}

if (!$_SESSION['role'] >= 3) {
    header("Location: ./index.php");
}

require_once('models/Department.php');
require_once('models/User.php');
require_once('base_controller.php');
require_once('function.php');

class DepartmentController extends BaseController
{
    function __construct()
    {
        $this->name = 'department';
    }

    public function index()
    {
        // Giao diện quản lý ngày nghỉ phép của nhân viên và trưởng phòng
        $departments = Department::getAll();
        $data = array('departments' => $departments);
        $this->render('index', $data);
    }

    public function view()
    {
        // If user already login then head back to index
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $department = Department::getDetail($id);
        $data = array('department' => $department);
        $this->render('view', $data);
    }

    public function createDepartment()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['roomQuantity'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['roomQuantity'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (intval($_POST['roomQuantity']) < 1) {
            die(json_encode(array('code' => 2, 'message' => 'Số phòng không được bé hơn 1!')));
        }

        // $result = Department::createDepartment($_POST);
    }
}
