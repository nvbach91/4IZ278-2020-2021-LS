<?php require_once __DIR__ . '/db.php'; ?>
<?php

class OrdersProductsDB extends Database {
    protected $tableName = 'ordersproducts';

    function createOrderProducts($orderContent) {
        $sql = "INSERT INTO $this->tableName(orders_id, products_id) VALUES (:orders_id, :products_id)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'orders_id' => $orderContent['order_id'],
            'products_id' => $orderContent['product_id']
        ]);
    }

}
?>