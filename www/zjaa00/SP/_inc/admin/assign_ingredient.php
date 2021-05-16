<?php
  require_once "../config.php";

  if ($_GET['drink_id']) {
    $insert = $connect->prepare('
      INSERT INTO drinks_ingredients (drink_id, ingr_id, volume)
      VALUES (:drink_id, :ingr_id, :ingr_volume);
    ');
    $insert->execute([
      'drink_id' => $_GET['drink_id'],
      'ingr_id' => $_POST['ingr_id'],
      'ingr_volume' => $_POST['ingr_volume'],
    ]);

    header('Location: ../../edit_item.php?drink_id='.$_GET['drink_id']);
  }