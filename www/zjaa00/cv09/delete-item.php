<?php
  require("./_inc/config.php");

  if (session_id() == '') {
    session_start();
  }

  if (@$_SESSION['user_privilege'] < 2) {
    header('Location: logout.php');
    die();
  }

  $stmt = $connect->prepare("DELETE FROM goods WHERE id = :id;");
  $stmt->execute(['id' => $_GET['id']]);

  header("Location: home.php");