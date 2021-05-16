<?php

require_once  __DIR__ . '/Database.php';

class CategoriesDB extends AbstractDatabase {
    protected $tableName = 'categories';

    public function fetchAll() {
        $sql = 'SELECT c.category_id, c.number, c.name, IFNULL(p.pocet, 0) AS "pocet_cat"
                FROM ( 
                    SELECT category AS "cat_id", COUNT(category) AS "pocet" 
                    FROM `products` GROUP BY category 
                ) p RIGHT JOIN ' . $this->tableName . ' c ON c.category_id = p.cat_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(number, name) VALUES (:number, :name)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'number' => $args['number'], 
            'name' => $args['name']
        ]);
    }
} 