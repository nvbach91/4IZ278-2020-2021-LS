<?php

require './_inc/config.php';
require 'user_required.php'; // pristup jen pro prihlaseneho uzivatele

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$stmt = $connect->prepare('SELECT * FROM goods WHERE id = :id');
$stmt->execute([
    'id' => $_GET['id']
]);
$goods = $stmt->fetch();

if (!$goods) {
    exit('Unable to find goods!');
}

$_SESSION['cart'][] = $goods['id'];

header('Location: cart.php');

?>
