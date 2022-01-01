<?php

require_once('config.php');
require_once('function.php');

session_start();
// Phần quyền
$access_control = array(
    1 => array(
        'login' => array(
            'login', 'logout',
            'view', 'viewChangePassword', 'changePassword'
        ),
        'user' => array('viewProfile', 'confirmChange', 'uploadAvatar'),
        'leave' => array('index', 'createRequest'),
        'task' => array('index')
    ),
    2 => array(
        'login' => array(
            'login', 'logout',
            'view', 'viewChangePassword', 'changePassword'
        ),
        'user' => array('viewProfile', 'confirmChange', 'uploadAvatar'),
        'leave' => array('index', 'indexRequest', 'viewRequest', 'createRequest', 'acceptRequest', 'rejectRequest'),
        'task' => array('index')
    ),
    3 => array(
        'login' => array(
            'login', 'logout',
            'view', 'viewChangePassword', 'changePassword'
        ),
        'user' => array('viewProfile', 'confirmChange', 'uploadAvatar'),
        'leave' => array('indexRequest', 'viewRequest', 'acceptRequest', 'rejectRequest')
    ),
    4 => array(
        'login' => array(
            'login', 'logout',
            'view', 'viewChangePassword', 'changePassword'
        ),
        'user' => array('index', 'view', 'viewProfile', 'confirmChange', 'uploadAvatar'),
        'leave' => array('index', 'view', 'indexRequest', 'viewRequest', 'createRequest', 'acceptRequest', 'rejectRequest'),
        'task' => array('index', 'view')
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

    if ($role == 1 || $role == 2) {
        // Set default homepage
        $defaultController = 'task';
        $defaultAction = 'index';
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
