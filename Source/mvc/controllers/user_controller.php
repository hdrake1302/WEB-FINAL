<?php
require_once('models/User.php');
require_once('base_controller.php');
require_once('function.php');

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

    // ---------------- USER PROFILE --------------------
    public function viewProfile()
    {
        $user = User::get($_SESSION['id']);
        $this->render('viewProfile', array('user' => $user));
    }

    public function confirmChange()
    {
        /*
        Function that let the user change their passsword
        */
        $_SESSION['activated'] = 0;
        $user = User::updateActivated($_SESSION['id']);
        header("Location: ./index.php?controller=login&action=viewChangePassword");
    }

    public function uploadAvatar()
    {
        /*
        An API that let user change their avatar
        */
        $path = dirname(dirname(__FILE__));

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_FILES)) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        $supported_extensions = array("jpg", "png");

        $extension = pathinfo($_FILES['file']['name'])['extension'];

        // Kiểm tra extension
        if (!in_array($extension, $supported_extensions)) {
            die(json_encode(array('code' => 2, 'message' => "The file type is not allowed")));
        }

        $file_size = $_FILES['file']['size'];

        if ($file_size >= 500 * 1024 * 1024) {
            die(json_encode(array('code' => 3, 'message' => "file exceeds the maximum allowed size")));
        }

        $upload_path = "$path\\assets\\uploads\\avatars\\";
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];

        // Đặt tên ảnh với token để tránh bị lấy dữ liệu
        $file = USER::getToken($_SESSION['id']) . "_" . $file_name;


        if (file_exists($upload_path . $file)) {
            die(json_encode(array('code' => 4, 'message' => "File already exists!")));
        }

        // Ảnh đại diện cũ
        $oldAvatar = pathinfo(User::getAvatar($_SESSION['id']))['basename'];
        $avatarPath = URL . 'assets/uploads/avatars/' . $file;

        $update_result = User::updateAvatar($_SESSION['id'], $avatarPath);
        if ($update_result === false) {
            die(json_encode(array('code' => 1, 'message' => "Không thể upload lên database!")));
        }

        $result = move_uploaded_file($file_tmp, $upload_path . $file);
        if ($result) {
            if ($oldAvatar) {
                // Xóa ảnh cũ
                unlink($upload_path . $oldAvatar);
            }
            $_SESSION['avatar'] = $avatarPath;

            echo json_encode(array('code' => 0, 'message' => "Cập nhật ảnh đại diện thành công", 'avatar' => $avatarPath));
        } else {
            die(json_encode(array('code' => 1, 'message' => "FAILED!")));
        }
    }
    // ---------------- USER PROFILE --------------------

    // ---------------- ADMIN --------------------
    public function createAccount()
    {
        /*
        An API to create an new account for a employee
        */
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
        }

        if (!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['username']) || !isset($_POST['department'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['username']) || empty($_POST['department'])) {
            die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
        }

        $result = User::createAccount($_POST);
        if ($result) {
            echo json_encode(array('code' => 0, 'message' => 'Tạo tài khoản thành công'));
        } else {
            die(json_encode(array('code' => 3, 'message' => 'Tạo tài khoản thất bại!')));
        }
    }
    // ---------------- ADMIN --------------------
}
