<?php
require __DIR__ . '/config.php';

session_start();

$id = @$_GET['id'];
foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}

header('Location: cart.php');
exit();
