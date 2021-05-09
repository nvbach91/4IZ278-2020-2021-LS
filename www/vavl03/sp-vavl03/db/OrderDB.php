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
    public function createOrder($orderValue,$userId, $orderDate, $deliveryMethod, $paymentMethod,$productIds)
    {
        //$conn = $this->getPdo();
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

        // potřebuju id všech produktů pokud více kusů od jednoho
        foreach ($productIds as $id){
            $sql = "UPDATE `product` SET `order_order_id` = :lastId WHERE product_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':lastId' => $last_id,
                ':id' => $id
            ]);
        }
        
    }
    public function fetchUserOrders($fbId){
        
        $sql = "SELECT * FROM `order` o
         WHERE `user_user_id` = (SELECT `user_id` FROM `user` WHERE user_fb_id = :fbId)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':fbId' => $fbId]);
        return $stmt->fetchAll();

        //INNER JOIN product p ON o.order_id = p.order_order_id
        //SELECT * FROM `order` WHERE `user_user_id` = (SELECT `user_id` FROM `user` WHERE `user_fb_id` = :fbId);
        //3846473148722651
    }

    public function deleteOrder($orderId){
        $sql = "DELETE FROM `order` WHERE `order_id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $orderId]);
    }
}


//$sql = "UPDATE `product` SET `order_order_id` = 12 WHERE product_id = 5";
/*INSERT INTO `order`(`order_value`,`user_user_id`, `order_date`, `delivery_method`, `payment_method`, `products`)
VALUES (1200,10,'2021-05-03','homeDelivery','bankTransfer','{"asus":1}');
INSERT INTO `product` (`order_order_id`) VALUES (SELECT LAST_INSERT_ID()) WHERE ; */
?>