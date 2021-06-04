<?php
  require_once __DIR__ . '/BaseDatabase.php';

  class ProductsDatabase extends BaseDatabase
  {
    /**
     * UsersDatabase constructor.
     */
    public function __construct()
    {
      parent::__construct("products");
    }

    public function create($args) {
      $sql = 'INSERT INTO ' . $this->getTableName() . '(name, price, img) VALUES (:name, :price, :img)';
      $statement = $this->pdo->prepare($sql);
      $statement->execute([
        'name' => $args['name'],
        'price' => $args['price'],
        'img' => $args['img']
      ]);
    }
  }