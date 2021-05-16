<?php

  if (!isset($_COOKIE['email'])) {
    header('Location: login.php');
    die();
  }
  
  $select = $connect->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
  $select->execute([
    'email' => $_COOKIE['email']
  ]);
  $current_user = $select->fetchColumn();
  
  if (!$current_user || !authorize(1)) {
    header('Location: ./logout.php');
    die();
  }