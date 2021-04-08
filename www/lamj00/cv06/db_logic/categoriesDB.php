<?php
require_once "database_logic.php";
class CategoriesDB extends Database {
    protected $tableName = 'categories';
    public function fetchAll(): array
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}

/*
INSERT INTO `categories`( `number`, `name`) VALUES (0,"Action");
INSERT INTO `categories`( `number`, `name`) VALUES (1,"Sports");
INSERT INTO `categories`( `number`, `name`) VALUES (2,"Simulator");
INSERT INTO `categories`( `number`, `name`) VALUES (3,"Shooter");
INSERT INTO `categories`( `number`, `name`) VALUES (4,"IDK");
*/