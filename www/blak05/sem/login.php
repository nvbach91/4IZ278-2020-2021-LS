<?php 
    setcookie('priv', 1, time() + 360);
    header('Location: index.php');
?>