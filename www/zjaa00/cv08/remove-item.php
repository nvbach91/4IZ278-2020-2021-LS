<?php
  session_start();
  print_r($_SESSION['cart']);
  
  foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $_GET['id']) {
      unset($_SESSION['cart'][$key]);
    }
  }
  print_r($_SESSION['cart']);
  header("Location: cart.php");