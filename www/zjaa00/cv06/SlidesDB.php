<?php

require_once  './Database.php';

class SlidesDB extends Database {
    protected $table_name = 'slides';

    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->table_name;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($colums) {
        $sql = 'INSERT INTO ' . $this->table_name . '(img, title) VALUES (:img, :title)';
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'img' => $colums['img'], 
            'title' => $colums['title'],
        ]);
    }
} 