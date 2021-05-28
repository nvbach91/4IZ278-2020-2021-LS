<?php require __DIR__ . '/../db/OrderDB.php'; ?>
<?php require __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
session_start();
$orderId = @$_POST['id'];
// first cancel order_order_id from products
$productsDB = new ProductsDB();
$productsDB->deleteOrderId($orderId);

// cancel order
$ordersDB = new OrdersDB();
$ordersDB->deleteOrder($orderId);
header('Location: ../my_orders.php');
exit();
?>