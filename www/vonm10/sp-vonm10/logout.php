<?php
session_start();    
unset($_SESSION['admin']);
unset($_SESSION['user_id']);
unset($_SESSION['cart']);
unset($_SESSION['totalPrice']);
$_SESSION['login'] = false;
header('Location: /~vonm10/beardwithme/index.php');
