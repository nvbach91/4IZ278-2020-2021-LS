<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class SlideDB extends Database
{
    protected $tableName = 'slide';
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>