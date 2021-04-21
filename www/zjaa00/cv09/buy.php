<?php 
  require("./_inc/config.php");

  if (session_id() == '') {
    session_start();
  }

  if (@!$_SESSION['user_privilege']) {
    header('Location: logout.php');
    die();
  }

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }


  if (isset($_GET)) {
    
    $email = @$_SESSION['user_email'];
    $validation = $connect->prepare("SELECT email FROM users WHERE email = :email;");
    $validation->execute(["email" => $email]);
    $validation = $validation->fetchColumn();
    
    if ($email !== $validation) {
      die('You have to login first!');
    }

    $stmt = $connect->prepare('SELECT * FROM goods WHERE id = :id');
    $stmt->execute(['id' => $_GET['id']]);
    $goods = $stmt->fetch();

    if (!$goods) {
        die('Unable to find goods!');
    }

    array_push($_SESSION['cart'], $_GET['id']);
    header('Location: cart.php');
  }