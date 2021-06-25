<?php require_once __DIR__ . '/db.php'; ?>
<?php

class OrdersDB extends Database {
    protected $tableName = 'orders';

    function createOrder($orderInfo) {
        $sql = "INSERT INTO $this->tableName(total_price, users_id, date, delivery, payment) VALUES (:total_price, :users_id, :date, :delivery, :payment)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'total_price' => $orderInfo['total_price'],
            'users_id' => $orderInfo['user_id'],
            'date' => $orderInfo['date'],
            'delivery' => $orderInfo['delivery'],
            'payment' => $orderInfo['payment']
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