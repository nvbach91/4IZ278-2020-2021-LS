<?php require_once __DIR__ . '/db.php'; ?>
<?php

class OrdersDB extends Database {
    protected $tableName = 'orders';

    function createOrder($priceTotal, $user_id) {
        $sql = "INSERT INTO $this->tableName(total_price, users_id) VALUES (:total_price, :users_id)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'users_id' => $user_id,
            'total_price' => $priceTotal
        ]);
    }

    function findLastOrderID() {
        $sql = "SELECT LAST_INSERT_ID();";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $order_id = $statement->fetchColumn();
        return $order_id;
    }

}
?>