<?php

require_once  __DIR__ . '/database.php';

class ProductsDB extends AbstractDatabase {
    protected $tableName = 'products';
    protected $joinTableName = 'categories';
    private $baseSelectSql;

    public function __construct() {
        parent::__construct();
        $this->baseSelectSql = 'SELECT p.name, p.img, p.price, p.rating, p.description, c.name as "cat_name" 
            FROM ' . $this->tableName .  ' p JOIN ' . $this->joinTableName . ' c on p.category = c.category_id';
    }

    public function fetchAll() {
        $sql = $this->baseSelectSql . ';';

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchAllOrderedBy($fields) {
        $orderText = '';
        foreach($fields as $key=>$field) {
            $ordering = !key_exists('order', $field) ? 'ASC' : $field['order'];
            $addcomma = $key == count($fields) - 1 ? '' : ',';
            $orderText .= ' ' . $field['name'] . ' ' . $ordering . $addcomma;
        }

        $sql = $this->baseSelectSql . " ORDER BY$orderText;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(name, img, price, rating, description) VALUES (:name, :img, :price, :rating, :description)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'],
            'img' => $args['img'], 
            'price' => $args['price'],
            'rating' => $args['rating'], 
            'description' => $args['description'] ? $args['description'] : null
        ]);
    }
}
