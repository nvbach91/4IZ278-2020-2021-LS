<?php
session_start();
// allow user to create new order here, because first user_required check happens when user clicks buy in cart
if (isset($_SESSION['orderSent'])) {
    unset($_SESSION['orderSent']);
}
header('Location: ../order_methods.php');
?>