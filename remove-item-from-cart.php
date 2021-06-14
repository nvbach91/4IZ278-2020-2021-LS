<?php 
  require("./config/config.php");
  session_start();

  if (isset($_GET)) {

    $key=array_search($_GET['id'],$_SESSION['cart']);
    if($key!==false)
    unset($_SESSION['cart'][$key]);
    header('Location: cart.php');
  } 