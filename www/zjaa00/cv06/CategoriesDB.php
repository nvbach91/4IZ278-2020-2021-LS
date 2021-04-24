<?php
  require_once './Database.php';

  class CategoriesDB extends Database {
    protected $table_name = 'categories';

    public function fetchAll() {
      $sql = "SELECT * FROM " . $this->table_name;
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    }

    public function create($columns) {
        $sql = 'INSERT INTO ' . $this->table_name . '(number, name) VALUES (:number, :name)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'number' => $columns['number'], 
            'name' => $columns['name']
        ]);
    }

  }