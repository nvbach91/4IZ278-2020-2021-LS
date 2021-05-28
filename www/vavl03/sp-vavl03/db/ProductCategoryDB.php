<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ProductCategoryDB extends Database
{
    protected $tableName = 'product_has_category';
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>