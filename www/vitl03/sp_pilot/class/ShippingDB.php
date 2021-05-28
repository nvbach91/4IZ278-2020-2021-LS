<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class ShippingDB extends Database
{
    protected $tableName = 'shipping';
    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE shipping_id = ?');
        $statement->execute([$id]);
        // Fetch the product from the database and return the result as an Array
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}

?> 