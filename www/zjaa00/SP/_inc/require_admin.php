<?php

  if (!isset($_COOKIE['email'])) {
    header('Location: signin.php');
    die();
  }
  
  $stmt = $connect->prepare('SELECT * FROM users WHERE email = :email AND privilege = 2 LIMIT 1');
  $stmt->execute([
    'email' => $_COOKIE['email']
  ]);
  
  $current_user = $stmt->fetchColumn();
  
  if (!$current_user || !authorize(2)) {
    header('Location: logout.php');
    die();
  }