<?php 
    class UspishnistController{
        public $model;

        public function __construct(){
            $this->model = new UspishnistModel;
        }

        public function redirect($url){
            if($url) header('Location: '.$url);
        }

        public function index(){
            $search = $_GET['search'] ?? '';
            
            if (!empty($search)) {
                $uspishnist = $this->model->searchStudents('%' . $search . '%');
            } else {
                $uspishnist = $this->model->getItems();
            }

            $students = $this->model->getStudents();
            $subjects = $this->model->getSubjects();
            include 'views/uspishnist.php';
        }
        
        public function add(){
            if($_POST){
                $this->model->add();
            }
            $this->redirect("/index.php/uspishnist");
        }

        public function actions(){
            if($_POST['delete']) $this->model->delete();
            if($_POST['update']) $this->model->update();
            $this->redirect("/index.php/uspishnist");
        }
    }
?>