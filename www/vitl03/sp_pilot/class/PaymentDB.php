<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class PaymentDB extends Database
{
    protected $tableName = 'payment';
    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE payment_id = ?');
        $statement->execute([$id]);
        // Fetch the product from the database and return the result as an Array
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}

?> 