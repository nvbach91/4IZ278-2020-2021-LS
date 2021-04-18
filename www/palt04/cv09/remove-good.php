<?php
  require("./manager-required.php");
  require("./config/config.php");

  $stmt = $connect->prepare("DELETE FROM goods WHERE id = :id;");
  $stmt->execute(['id' => $_GET['id']]);

  header("Location: index.php"); 