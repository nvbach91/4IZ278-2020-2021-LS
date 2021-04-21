<?php require __DIR__ . '/database_connection.php';?>
<?php require __DIR__ . '/user_required.php';?>
<?php
session_start();

$id = @$_GET['id'];
foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}

header('Location: cart.php');
exit();
?>