
<?php
if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
}

if (!$_SESSION['role'] == 3) {
    header("Location: ./index.php");
}

require_once('models/Department.php');
require_once('models/Leave.php');
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

        $_POST['id'] = Department::getNextID();
        $result = Department::createDepartment($_POST);

        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Tạo phòng ban thành công!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Tạo phòng ban thất bại!')));
        }
    }

    public function editDepartment()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['roomQuantity'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['description']) || empty($_POST['roomQuantity'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (intval($_POST['roomQuantity']) < 1) {
            die(json_encode(array('code' => 2, 'message' => 'Số phòng không được bé hơn 1!')));
        }

        $result = Department::editDepartment($_POST);

        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Sửa phòng ban thành công!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Sửa phòng ban thất bại!')));
        }
    }

    public function appointManager()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['user_id']) || !isset($_POST['department_id'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['user_id']) || empty($_POST['department_id'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (User::isManager($_POST['user_id'])) {
            die(json_encode(array('code' => 5, 'message' => 'Không thể bổ nhiệm vì user hiện tại đang là trưởng phòng')));
        }

        if (Department::existManager($_POST['department_id'])) {
            // Nếu đã có trưởng phòng thì set role lại bằng 1, total_leaves = 12
            User::setRole(Department::getManagerID($_POST['department_id']), 1);
            Leave::setTotalLeaves(Department::getManagerID($_POST['department_id']), 12);
        }


        // Bổ nhiệm trưởng phòng
        User::setRole($_POST['user_id'], 2);
        Leave::setTotalLeaves($_POST['user_id'], 15);

        $result = Department::appointManager($_POST['department_id'], $_POST['user_id']);

        if ($result && $result) {
            echo json_encode(array('code' => 0, 'message' => 'Bổ nhiệm trưởng phòng thành công!'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Bổ nhiệm trưởng phòng thất bại!')));
        }
    }
}
