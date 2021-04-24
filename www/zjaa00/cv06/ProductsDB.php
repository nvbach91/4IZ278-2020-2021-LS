<?php
  require_once "./Database.php";

  class ProductsDB extends Database {
    protected $table_name = 'products';
    protected $sql;

    public function __construct() {
      parent::__construct();
      $this->sql = "SELECT * FROM " . $this->table_name;
    }
    public function fetchAll() {
      $stmt = $this->db->prepare($this->sql);
      $stmt->execute();
      return $stmt->fetchAll();
    }

    public function create($columns) {
      $sql = 'INSERT INTO ' . $this->table_name . '(name, price, img) VALUES (:name, :price, :img)';
      $stmt = $this->db->prepare($sql);
      $stmt->execute([
          'name' => $columns['name'],
          'price' => $columns['price'],
          'img' => $columns['img'], 
      ]);
  }
  }