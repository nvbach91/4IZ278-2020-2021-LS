<?php
require_once "database_logic.php";
class SlidesDB extends Database {
    protected $tableName = 'slides';
    public function fetchAll(): array
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}
