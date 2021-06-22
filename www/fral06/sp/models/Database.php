<?php


?>

<?php

abstract class Database {

    protected $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
            /* DSN */
                'mysql:host=' . 'localhost' . ';dbname=' . 'mydb' . ';charset=utf8mb4',
                /* USR */
                'root',
                /* PWD */
                'root'
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // allows LIMIT
        } catch (PDOException $e) {
            exit('Connection to DB failed: ' . $e->getMessage());
        }
    }
}
