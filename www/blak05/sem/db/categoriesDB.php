<?php require_once __DIR__ . '/db.php'; ?>
<?php

class CategoriesDB extends Database
{
    protected $tableName = 'Categories';
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args)
    {
        //
    }
    public function fetch($args)
    {
        //
    }
    public function update($args)
    {
       //
    }
    public function delete($args)
    {
        //
    }
}

?>