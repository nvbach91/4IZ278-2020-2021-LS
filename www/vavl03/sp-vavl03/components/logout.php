<?php
session_start();
//session_destroy();

unset($_SESSION['fb_access_token']);
header('Location: ../index.php');
// logout by destroying cookie
//setcookie('name', '', time());
//header('Location: index.php');
?>