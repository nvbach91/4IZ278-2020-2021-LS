<?php

class Ingredient {
  public $table_name = "ingredients";
  public $connect;

  public function __construct($db) {
    $this->connect = $db;
  }

  function create($args) {
    $sql = "INSERT INTO " . $this->table_name . "(name, percentage) VALUES (:name, :percentage);";
    $insert = $this->connect->prepare($sql);
    $insert->execute($args);
  }

  function delete($ingr_id) {
    $delete = $this->connect->prepare('
      DELETE FROM ingredients
      WHERE ingr_id = :ingr_id;
    ');
    $delete->execute([
      ":ingr_id" => $ingr_id,
    ]);

  }

}

?>