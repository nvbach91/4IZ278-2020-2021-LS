<?php require_once 'database_connection.php' ?>
<?php 
    class ProductsDB extends Database {
        protected $tableName = 'products';
        public function fetchAll() {
            $sql = 'SELECT * FROM ' . $this->tableName;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        }
    }
?>