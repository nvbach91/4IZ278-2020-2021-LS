<?php require_once 'database_connection.php' ?>
<?php 
    class CategoriesDB extends Database {
        protected $tableName = 'categories';
        public function fetchAll() {
            $sql = 'SELECT * FROM ' . $this->tableName;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        }
    }
?>