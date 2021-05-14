<?php require_once __DIR__ . '/db.php'; ?>
<?php

class ProductsDB extends Database
{
    protected $tableName = 'goods';
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args)
    {
        // another function
    }
    public function fetch($args)
    {
        // another function
    }
    public function update($args)
    {
        // another function  
    }
    public function delete($args)
    {
        // another function
    }
}

?>