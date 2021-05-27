<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class OrdersDB extends Database
{
    protected $tableName = 'orders';
    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE order_id = ?');
        $statement->execute([$id]);
        // Fetch the product from the database and return the result as an Array
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchByEmail($email)
    {
        $statement = $this->pdo->prepare('SELECT order_id, date FROM ' . $this->tableName . ' WHERE email LIKE ? AND date=NOW()');
        $statement->execute([$email]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAllByEmail($email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE email LIKE ? ORDER BY date desc');
        $statement->execute([$email]);

        return $statement->fetchAll();
    }
    public function insert($userEmail, $total, $user, $payment, $shipping, $detail, $firstName, $lastName, $address, $city, $country, $zipcode, $phone)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->tableName . '(`email`, `amount`, `user_id`, `payment_id`, `shipping_id`, `date`,`detail`,`firstName`,`lastName`,`address`,`city`,`country`,`zipcode`,`phone`) VALUES (? , ? , ? , ?, ?, NOW(), ?, ?, ? , ? , ?, ?, ?, ?)');
        $statement->execute(array($userEmail, $total, $user, $payment, $shipping, $detail, $firstName, $lastName, $address, $city, $country, $zipcode, $phone));
    }
}

?> 