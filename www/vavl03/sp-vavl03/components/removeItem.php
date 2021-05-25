<?php
session_start();
//remove product id from cart session
$id = @$_POST['id'];
foreach ($_SESSION['cart'] as $key => $value) {
    if ($key == $id) {
        unset($_SESSION['cart'][$key]);
    }
}
header('Location: ../cart.php');
exit();
