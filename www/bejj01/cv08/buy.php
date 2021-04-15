<?php

require __DIR__ . '/db.php';
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$sql = "SELECT * FROM goods WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => @$_GET['id']]);
$goods = $stmt->fetch();
if (!$goods){
    exit("Good with id not found!");
}

array_push($_SESSION['cart'], $goods["id"]);
header('Location: cart.php');
exit();


?>