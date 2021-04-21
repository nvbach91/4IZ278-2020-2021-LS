<?php
  if (session_id() == '') {
    session_start();
  }
  print_r($_SESSION['cart']);
  
  if (@!$_SESSION['user_privilege']) {
    header('Location: logout.php');
    die();
  }

  foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $_GET['id']) {
      unset($_SESSION['cart'][$key]);
    }
  }
  print_r($_SESSION['cart']);
  header("Location: cart.php");