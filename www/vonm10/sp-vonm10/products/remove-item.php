<?php

session_start();

$id = $_GET['id'];
if(in_array($id,$_SESSION['cart']))
{   $index = array_search($id, $_SESSION['cart']);
    unset($_SESSION['cart'][$index]);
}

header('Location:cart.php');
