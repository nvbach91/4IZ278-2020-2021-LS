<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class CategoriesDB extends Database
{

    protected $tableName = 'categories';
    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT name FROM ' . $this->tableName . ' WHERE category_id=?');
        $statement->execute(array(htmlspecialchars($_GET['category'])));
        return $statement->fetch();
    }

    public function fetchAll2()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create()
    {
        // create
    }
    public function update()
    {
        // update
    }
    public function delete()
    {
        // delete category
    }
}

?> 