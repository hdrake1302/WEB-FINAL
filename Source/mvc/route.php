<?php
$supported_controllers = array(
    'user' => array('index', 'view', 'viewProfile', 'confirmChange', 'uploadAvatar', 'createAccount'),
    'task' => array('index', 'view'),
    'leave' => array('index', 'view', 'indexRequest', 'viewRequest', 'createRequest', 'acceptRequest', 'rejectRequest'),
    'login' => array(
        'login', 'logout',
        'view', 'viewChangePassword', 'changePassword'
    ),
    'pages' => array('error')
);

if (
    !array_key_exists($controller, $supported_controllers) ||
    !in_array($action, $supported_controllers[$controller])
) {
    $controller = 'pages';
    $action = 'error';
}

include_once("controllers/" . $controller . "_controller.php"); // PagesController
$className = ucfirst($controller) . "Controller";

$obj = new $className();
$obj->$action();
