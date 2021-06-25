<?php require_once __DIR__ . '/db.php'; ?>
<?php

class OrdersContentDB extends Database {
    protected $tableName = 'orders_content';

    function createOrderContent($order_id, $product, $quantity) {
        $sql = "INSERT INTO $this->tableName(orders_id, products_id, quantity) VALUES (:orders_id, :products_id, :quantity)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'orders_id' => $order_id,
            'products_id' => $product,
            'quantity' => $quantity
        ]);
    }

}
?>