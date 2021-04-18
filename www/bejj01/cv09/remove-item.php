<?php
    require __DIR__ . '/user-required.php';

    $id = @$_GET['id'];

    $index = array_search($id, $_SESSION['cart']);

    if (isset($index)) {
        unset($_SESSION['cart'][$index]);
    }

    header('Location: cart.php');
    exit();
?>