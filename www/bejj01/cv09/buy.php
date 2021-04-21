<?php
    require __DIR__ . '/user-required.php';
    require __DIR__ . '/db.php';

    $_SESSION['offset'] = $_GET['offset'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $sql = "SELECT * FROM goods WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => @$_GET['id']]);
    $goods = $stmt->fetch();
    if (!$goods){
        header('Location: not-found.php');
        exit("Good with id not found!");
    }

    if (!in_array($goods["id"], $_SESSION['cart'])) {
        array_push($_SESSION['cart'], $goods["id"]);
    }

    header('Location: cart.php');
    exit();
?>