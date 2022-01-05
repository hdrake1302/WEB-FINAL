<?php

require_once('config.php');
require_once('function.php');

session_start();

// if (!isset($_SESSION['last_access'])) {
//     $_SESSION['last_access'] = time();
// }

// if ((time() - $_SESSION['last_access']) > 10) {
//     unset($_SESSION);
//     session_destroy();
// }

// Phần quyền
$access_control = array(
    1 => array(
        'login' => array(
            'login', 'logout',
            'view', 'viewChangePassword', 'changePassword'
        ),
        'user' => array('viewProfile', 'confirmChange', 'uploadAvatar'),
        'leave' => array('index', 'createRequest'),
        'task' => array('indexStaff', 'viewStaff', 'startTask', 'submitTask', 'indexHistory', 'viewHistory')
    ),
    2 => array(
        'login' => array(
            'login', 'logout',
            'view', 'viewChangePassword', 'changePassword'
        ),
        'user' => array('viewProfile', 'confirmChange', 'uploadAvatar'),
        'leave' => array('index', 'indexRequest', 'viewRequest', 'createRequest', 'acceptRequest', 'rejectRequest'),
        'task' => array('indexManager', 'viewManager', 'createTask', 'cancelTask', 'indexHistory', 'viewHistory', 'approveTask', 'rejectTask')
    ),
    3 => array(
        'login' => array(
            'login', 'logout',
            'view', 'viewChangePassword', 'changePassword'
        ),
        'user' => array('index', 'view', 'viewProfile', 'confirmChange', 'uploadAvatar', 'createAccount'),
        'leave' => array('indexRequest', 'viewRequest', 'acceptRequest', 'rejectRequest'),
        'department' => array('index', 'view', 'createDepartment', 'editDepartment', 'appointManager')
    ),
    4 => array(
        'login' => array(
            'login', 'logout',
            'view', 'viewChangePassword', 'changePassword'
        ),
        'user' => array('index', 'view', 'viewProfile', 'confirmChange', 'uploadAvatar', 'createAccount'),
        'leave' => array('index', 'view', 'indexRequest', 'viewRequest', 'createRequest', 'acceptRequest', 'rejectRequest'),
        'task' => array('indexStaff', 'viewStaff', 'indexManager', 'viewManager', 'createTask', 'startTask', 'submitTask', 'cancelTask', 'indexHistory', 'viewHistory', 'approveTask', 'rejectTask'),
        'department' => array('index', 'view', 'createDepartment', 'editDepartment', 'appointManager')
    )
);

if (!isset($_SESSION['id'])) {
    // Chưa login thì chuyển hướng tới login
    $controller = 'login';

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'view';
    }
} else {
    $defaultController = 'user';
    $defaultAction = 'index';

    $role = $_SESSION['role'];

    if ($role == 1) {
        // Set default homepage
        $defaultController = 'task';
        $defaultAction = 'indexStaff';
    }
    if ($role == 2) {
        // Set default homepage
        $defaultController = 'task';
        $defaultAction = 'indexManager';
    }

    if (isset($_GET['controller'])) {
        $controller = $_GET['controller'];
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = 'index';
        }

        // ------- PHÂN QUYỀN -------------------
        if (!$access_control[$role][$controller]) {
            // Controller không nằm trong quyền hạn
            $controller = 'login';
            $action = 'view';
        } else if (!in_array($action, $access_control[$role][$controller])) {
            // Action không nằm trong quyền hạn
            $controller = 'login';
            $action = 'view';
        }
    } else {
        if ($_SESSION['activated'] == 0) {
            // Account chưa đổi mật khẩu
            $controller = 'login';
            $action = 'viewChangePassword';
        } else {
            // Homepage
            $controller = $defaultController;
            $action = $defaultAction;
        }
    }
}


// định tuyến
require_once('route.php');
