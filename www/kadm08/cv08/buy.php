<?php

require __DIR__ . '/db.php';

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$sql = "SELECT * FROM goods WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->execute(['id' => $_GET['id']]);
$goods = $statement->fetch();
if (!$goods){
    exit("Unable to find goods!");
}


$_SESSION['cart'][] = $goods["id"];
header('Location: cart.php');
exit();

?>

