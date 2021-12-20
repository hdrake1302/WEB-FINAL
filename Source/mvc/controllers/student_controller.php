<?php
    require_once('base_controller.php');
    require_once('models/Student.php');

    class StudentController extends BaseController {

        function __construct()
        {
            $this->name = 'student';
        }

        public function index() {

            $students = Student::getAll();
            $data = array('students' => $students);
            $this->render('index', $data);
        }

        public function view() {
            $id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_STRING);
            $student = Student::get($id);
            $this->render('view', array('student' => $student));
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
?>