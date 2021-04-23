<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/user_required.php';


$id = @$_POST['id'];
foreach ($_SESSION['cart'] as $key => $value){
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}
header('Location: cart.php');
exit();
?>