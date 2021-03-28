<?php require_once 'database_connection.php' ?>
<?php 
    class SlidesDB extends Database {
        protected $tableName = 'slides';
        public function fetchAll() {
            $sql = 'SELECT * FROM ' . $this->tableName;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        }
    }
?>