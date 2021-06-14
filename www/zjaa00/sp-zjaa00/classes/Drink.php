<?php

class Drink {
  public $table_name = "drinks";
  public $connect;

  public function __construct($db) {
    $this->connect = $db;
  }

  function create($args) {
    $sql = 'INSERT INTO ' . $this->table_name . '(name, volume, price, image, alcoholic, inflammatory, deadly, available) VALUES (:name, :volume, :price, :image, :alcoholic, :inflammatory, :deadly, :available)';
    $insert = $this->connect->prepare($sql);
    $insert->execute($args);
  }

  function delete($drink_id) {
    $delete = $this->connect->prepare("
      DELETE FROM drinks
      WHERE drink_id = :drink_id;;
    ");
    $delete->execute([
      "drink_id" => $drink_id,
      ]);
  }
}

?>