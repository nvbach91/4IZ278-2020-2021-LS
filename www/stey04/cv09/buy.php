<?php
require __DIR__ . '/config.php';
session_start();

if (!@$_SESSION['user_id']) {
    header('Location: index.php');
    exit('Please login or signup');
}
if (!@$_SESSION['cart']) {
    $_SESSION['cart'] = [];
}
$statement = $pdo->prepare("SELECT * FROM goods WHERE id = :id");
$statement->execute(['id' => $_GET['id']]);
$goods = $statement->fetch();
if (!$goods) {
    exit('No items!');
}
array_push($_SESSION['cart'], $goods['id']);
header('Location: cart.php');
exit();
