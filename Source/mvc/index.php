<?php

    require_once('config.php');
    require_once('function.php');

    // If user have logged in
    session_start();
    if (!isset($_SESSION['id'])){
        $controller = 'login';

        if (isset($_GET['action'])){
            $action = $_GET['action'];
        }else{
            $action = 'view';
        }
    }
    else{
        if (isset($_GET['controller'])) {
            $controller = $_GET['controller'];
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
            }else {
                $action = 'index';
            }
        }else {
            $role = $_SESSION['role'];

            if ($role == 1 && $_SESSION['activated'] == 0){
                // Staff
                $controller = 'changePass';
                $action = 'view';
            }else{
                $controller = 'user';
                $action = 'index';
            }
        }
    }
    

    // định tuyến
    require_once('route.php');

?>