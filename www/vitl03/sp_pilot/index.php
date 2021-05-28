<?php
session_start();
    

$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? htmlspecialchars($_GET['page']) : 'home';
// Include and show the requested page
include $page . '.php';
?>








