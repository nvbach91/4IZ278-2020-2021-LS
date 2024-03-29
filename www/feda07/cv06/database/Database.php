<?php
require __DIR__ . '/../config/global.php';

abstract class ADatabase
{


    protected $pdo;
    abstract function getTableName(): string;
    public function __construct() {
        //try {
        $this->pdo = new PDO(
        /* DSN */ 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            /* USR */ DB_USERNAME,
            /* PWD */ DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // allows LIMIT
        //} catch (PDOException $e) {
        //    exit('Connection to DB failed: ' . $e->getMessage());
        //}
    }

    public function fetchAll(){
         $sql = 'SELECT * FROM ' . $this->getTableName();
         $statement = $this->pdo->prepare($sql);
         $statement->execute();
         return $statement->fetchAll();
    }


}