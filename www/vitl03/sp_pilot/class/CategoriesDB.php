<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class CategoriesDB extends Database
{

    protected $tableName = 'categories';
    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchNameById($id)
    {
        $statement = $this->pdo->prepare('SELECT name FROM ' . $this->tableName . ' WHERE category_id=?');
        $statement->execute(array($id));
        return $statement->fetch();
    }


}

?> 