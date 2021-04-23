<?php 
    session_start();
    session_destroy();
    setcookie('privilege', '', time());
    header('Location: index.php');

?>