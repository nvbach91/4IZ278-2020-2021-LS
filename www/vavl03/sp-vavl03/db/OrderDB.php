<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class OrdersDB extends Database
{
    protected $tableName = 'order';
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id)
    {
        $sql = "SELECT * FROM order WHERE order_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    public function createOrder($orderValue, $userId, $orderDate, $deliveryMethod, $paymentMethod, $productIds)
    {
        $sql = "INSERT INTO `order`(`order_value`,`user_user_id`, `order_date`, `delivery_method`, `payment_method`)
         VALUES (:orderValue,( SELECT user_id FROM user WHERE user_fb_id = :userId),:orderDate,:deliveryMethod,:payMethod)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':orderValue' => $orderValue,
            ':userId' => $userId,
            ':orderDate' => $orderDate,
            ':deliveryMethod' => $deliveryMethod,
            ':payMethod' => $paymentMethod
        ]);
        $last_id = (int) $this->pdo->lastInsertId();

        foreach ($productIds as $id) {
            $sql = "UPDATE `product` SET `order_order_id` = :lastId WHERE product_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':lastId' => $last_id,
                ':id' => $id
            ]);
        }
    }
    public function fetchUserOrders($fbId)
    {

        $sql = "SELECT * FROM `order` o
         WHERE `user_user_id` = (SELECT `user_id` FROM `user` WHERE user_fb_id = :fbId)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':fbId' => $fbId]);
        return $stmt->fetchAll();
    }

    public function deleteOrder($orderId)
    {
        $sql = "DELETE FROM `order` WHERE `order_id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $orderId]);
    }
}

?>