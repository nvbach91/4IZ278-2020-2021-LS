<?php require "./db/Database.php" ?>
<?php

class ProductsDB extends Database {
    protected $tableName = 'product';

    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(product_id, product_name, price, image, category_id) 
                                                    VALUES (:product_id, :product_name, :price, :image, :category_id)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'product_id' => $args['product_id'], 
            'product_name' => $args['product_name'], 
            'price' => $args['price'],
            'image' => $args['image'],
            'category_id' => $args['category_id'],
        ]);
    }
    public function paginationProducts() {
        $itemsPerPagination = 4;
        if (isset($_GET['offset'])) {
            $offset = (int)$_GET['offset'];
        } else {
            $offset = 0;
        }
        
        $count = $this->pdo->query("SELECT COUNT(product_id) FROM product")->fetchColumn();
        $stmt = $this->pdo->prepare("SELECT * FROM product ORDER BY product_id DESC LIMIT $itemsPerPagination OFFSET ?");
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $goods = $stmt->fetchAll();
    }
}

?>