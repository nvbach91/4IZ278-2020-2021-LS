<?php 
  require("./_inc/config.php");

  if (session_id() == '') {
    session_start();
  }

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }


  if (isset($_GET)) {
    
    $username = @$_COOKIE['username'];
    $validation = $connect->prepare("SELECT username FROM users WHERE username = :username;");
    $validation->execute(["username" => $username]);
    $validation = $validation->fetchColumn();
    
    if ($username !== $validation) {
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