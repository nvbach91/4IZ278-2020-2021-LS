<?php
    require 'db.php';
    session_start();
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $sql = "SELECT * FROM goods WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $_GET['id']]);
    $goods = $stmt->fetch();
    if (!$goods){
        exit("Unable to find fish!");
    }

    $_SESSION['cart'][] = $goods["id"];
    header('Location: cart.php');
    exit();
?>