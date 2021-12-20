<?php
    $supported_controllers = array(
        'user' => array('index', 'view','edit','save','delete'),
        'login' => array('login', 'logout', 
        'view'),
        'changePass' => array('view', 'changePassword'),
        'pages' => array('error')
    );

    if (!array_key_exists($controller, $supported_controllers) ||
        !in_array($action, $supported_controllers[$controller])) {
        $controller = 'pages';
        $action = 'error';
    }

    include_once("controllers/" . $controller. "_controller.php"); // PagesController
    $className = ucfirst($controller) . "Controller";

    $obj = new $className();
    $obj->$action();
