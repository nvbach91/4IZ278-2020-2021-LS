<?php

require_once  __DIR__ . '/database.php';

class SliderDB extends AbstractDatabase {
    protected $tableName = 'slides';

    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(img, title) VALUES (:img, :title)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'img' => $args['img'], 
            'title' => $args['title']
        ]);
    }
} 