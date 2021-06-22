<?php
//Head
include "components/head.php";
//Navigation
include "components/nav.php";

session_start();

if ((($_SESSION['user_email']))) {
    header('Location: main.php');
}
?>

<h1>heya</h1>
