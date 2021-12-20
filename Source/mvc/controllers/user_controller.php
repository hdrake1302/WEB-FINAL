<?php
    require_once('models/User.php');
    require_once('base_controller.php');

    class UserController extends BaseController {

        function __construct()
        {
            $this->name = 'staff';
        }

        public function index() {

            $users = User::getAll();
            $data = array('users' => $users);
            $this->render('index', $data);
        }

        public function view() {
            $id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_STRING);
            $user = User::get($id);
            $this->render('view', array('user' => $user));
        }
        
        public function changePassword(){
            
        }

        public function edit() {
            echo 'Edit page of Student';
        }

        public function save() {
            echo 'Save page of Student';
        }

        public function delete() {
            echo 'Delete page of Student';
        }
    }
