<?php
  require_once "../config.php";
  
  if ($_GET['drink_id']) {
    $delete = $connect->prepare("
      DELETE FROM drinks_ingredients
      WHERE ingr_id = :ingr_id AND drink_id = :drink_id;
    ");
    $delete->execute([
      "drink_id" => $_GET['drink_id'],
      "ingr_id" => $_GET['ingr_id']
    ]);

    header('Location: ../../edit_item.php?drink_id='.$_GET['drink_id']);
  }