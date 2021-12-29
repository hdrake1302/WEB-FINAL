<?php
session_start();

$path = dirname(dirname(dirname(__FILE__)));
require_once($path . '\\config.php');

function convertToByte($size)
{
    // Input: MB size
    // Output: Converted into Bytes
    return $size * 1024 * 1024;
}

function updateAvatar($id, $img_path)
{
    $sql = "update account_info set avatar = :img_path where id = :id";
    $conn = DB::getConnection();
    $stm = $conn->prepare($sql);
    $stm->execute(array('id' => $id, 'img_path' => $img_path));

    return $stm->rowCount() == 1;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    die(json_encode(array('code' => 4, 'message' => 'API này chỉ hỗ trợ POST')));
}

if (!isset($_FILES)) {
    die(json_encode(array('code' => 1, 'message' => 'Thiếu thông tin đầu vào')));
}

$supported_extensions = array("jpg", "png");

$extension = pathinfo($_FILES['file']['name'])['extension'];

if (!in_array($extension, $supported_extensions)) {
    die(json_encode(array('code' => 2, 'message' => "The file type is not allowed")));
}

$file_size = $_FILES['file']['size'];

if ($file_size >= convertToByte(500)) {
    die(json_encode(array('code' => 3, 'message' => "file exceeds the maximum allowed size")));
}

$upload_path = "$path\\assets\\uploads\\";
$file_tmp = $_FILES['file']['tmp_name'];
$file_name = $_FILES['file']['name'];

if (file_exists($upload_path . $file_name)) {
    die(json_encode(array('code' => 4, 'message' => "File already exists!")));
}

$result = move_uploaded_file($file_tmp, $upload_path . $file_name);
if ($result) {
    $update_result = updateAvatar($_SESSION['id'], 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/' . $file_name);
    if ($update_result === false) {
        die(json_encode(array('code' => 1, 'message' => "FAILED")));
    }
    $_SESSION['avatar'] = 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/' . $file_name;
    echo json_encode(array('code' => 0, 'message' => "Successfully uploaded"));
} else {
    die(json_encode(array('code' => 1, 'message' => "FAILED")));
}
