<?php

require __DIR__ . '/config.php';
if (!@$_COOKIE['name']) {
    header('Location: index.php');
    exit();
}
session_start();
if (!@$_SESSION['cart']) {
    $_SESSION['cart'] = [];
}
$sql = "SELECT * FROM goods WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->execute(['id' => $_GET['id']]);
$goods = $statement->fetch();
if (!$goods) {
    exit('No items!');
}
//$_SESSION['cart'][] = $goods['id'];
array_push($_SESSION['cart'], $goods['id']);
header('Location: cart.php');
exit();
