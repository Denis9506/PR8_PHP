<?php 
    class SubjectsModel extends Model {

        public function getSubjectsFromDB(){
            $q = "SELECT * FROM subjects";
            return $this->db_select_array($q);
        }

        public function addSubjectToDB(){
            $q = $this->insert_db_query($_POST, 'subjects');
            echo $q;
            $this->db_query($q);
        }

        public function deleteSubjectFromDB(){
            $q = "DELETE FROM subjects WHERE id = ".$_POST['delete'];
            $this->db_query($q);
        }

        public function updateSubject(){
            $q = "UPDATE subjects SET name='".$_POST["name"]."' WHERE id = ".$_POST["update"];
            $this->db_query($q);
            die(json_encode($q));
        }

    }
?>