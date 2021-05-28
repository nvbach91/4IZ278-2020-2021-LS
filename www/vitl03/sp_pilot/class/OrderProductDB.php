<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class OrderProductDB extends Database
{
    protected $tableName = 'order_product';
    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchAllById($id, $orderId)
    {
        $statement = $this->pdo->prepare('SELECT quantity FROM ' . $this->tableName . ' WHERE product_id=? AND order_id=?');
        $statement->execute([$id, $orderId]);
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        $statement = $this->pdo->prepare('SELECT product_id FROM ' . $this->tableName . ' WHERE order_id=?');
        $statement->execute([$id]);
        return $statement->fetchAll();
    }

    public function insert($order, $product, $quantity)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->tableName . '(`order_id`, `product_id`,`quantity` ) VALUES (? , ?, ?)');
        $statement->execute(array($order, $product, $quantity));
    }
}

?> 