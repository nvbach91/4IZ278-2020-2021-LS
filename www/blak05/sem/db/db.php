<?php require __DIR__ . '/../config/global.php'; ?>
<?php require __DIR__ . '/dboperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct() {
        $this->pdo = new PDO(
            /* DSN */ 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            /* USR */ DB_USERNAME,
            /* PWD */ DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // allows LIMIT
    }
    public function fetchBy($field, $value) {
        // another function 
    }
    public function updateBy($conditions, $args) {
        // another function 
    }
    public function deleteBy($field, $value) {
        // another function 
    }
}

?>