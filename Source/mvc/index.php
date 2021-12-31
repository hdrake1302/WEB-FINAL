<?php

require_once('config.php');
require_once('function.php');

session_start();

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
