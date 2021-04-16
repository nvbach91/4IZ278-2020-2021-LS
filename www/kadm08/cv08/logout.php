<?php
    session_start();
    $_SESSION['cart'] = [];
    
    setcookie('email', '', time());
    header('Location: index.php');
?>    