<?php
  require_once "../_inc/config.php";
  require "../_inc/require_admin.php";
  
  if ($_GET['drink_id']) {
    $stmt = $connect->prepare("
      DELETE FROM drinks_ingredients
      WHERE ingr_id = :ingr_id AND drink_id = :drink_id;
    ");
    $stmt->execute([
      "drink_id" => $_GET['drink_id'],
      "ingr_id" => $_GET['ingr_id']
    ]);

    header('Location: ../edit_item.php?drink_id='.$_GET['drink_id']);
  }