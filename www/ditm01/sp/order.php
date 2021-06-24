<?php require __DIR__ . '/db/productsDB.php'; ?>
<?php require __DIR__ . '/db/ordersDB.php'; ?>
<?php require __DIR__ . '/db/ordersContentDB.php'; ?>
<?php 
if(!isset($_SESSION)){
    session_start();
}
$productsDB = new ProductsDB();
$ordersDB = new OrdersDB();
$ordersContentDB = new OrdersContentDB();

$ids = @$_SESSION['cart'];
$user_id = @$_SESSION['user_id'];
$user_email = @$_SESSION['user_email'];

if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';
    $products = $productsDB->fetchCartProducts($question_marks, $ids);
    $priceTotal = $productsDB->sumPrice($question_marks, $ids);
}


$order = $ordersDB->createOrder($priceTotal, $user_id);
$order_id = $ordersDB->findLastOrderID();
$quantity = 1;

foreach ($_SESSION['cart'] as $key=>$product) {
    $ordersContent = $ordersContentDB->createOrderContent($order_id, $product, $quantity);
}

unset($_SESSION['cart']);
header('Location: index.php?ref=order');
?>