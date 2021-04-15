<?php

require __DIR__ . "/model/ProductsDB.php";
session_start();

# session pole pro kosik
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$productDb = new ProductsDB();
$products = $productDb->fetchById( $_GET['id']);

if (!$products){
    exit("Unable to find goods!");
}
# pridame id zbozi do session pole
# TODO neresime, ze od jednoho zbozi muze byt vetsi mnozstvi nez 1, domaci ukol :)
$_SESSION['cart'][] = $products["product_id"];
header('Location: cart.php');
exit();
?>