<?php
  require("./_inc/config.php");

  $stmt = $connect->prepare("DELETE FROM goods WHERE id = :id;");
  $stmt->execute(['id' => $_GET['id']]);

  header("Location: index.php");