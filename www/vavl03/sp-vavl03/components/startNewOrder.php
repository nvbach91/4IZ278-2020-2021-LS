<?php
session_start();
if (isset($_SESSION['orderSent'])) {
    unset($_SESSION['orderSent']);
}
header('Location: ../order_methods.php');
