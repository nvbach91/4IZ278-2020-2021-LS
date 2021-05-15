<?php require __DIR__ . '/Database.php'; ?>
<?php

    class ProductsDB extends Database {
        protected $tableName = 'products';
        public function fetchAll() {
            $sql = 'SELECT * FROM ' . $this->tableName;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        }
        public function create($args) {
            $sql = 'INSERT INTO ' . $this->tableName . '(product_name, product_price, product_img) VALUES (:product_name, :product_price, :product_img)';
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'product_name' => $args['product_name'], 
                'product_price' => $args['product_price'], 
                'product_img' => $args['product_img'],
            ]);
        }
        ////
        public function fetchAllPaging($offset, $nItemsPerPagination) {
            $sql = "SELECT * FROM products ORDER BY product_id ASC LIMIT $nItemsPerPagination OFFSET ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $offset, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll();
        }
        public function countPages() {
            return $this->pdo->query("SELECT COUNT(product_id) FROM products")->fetchColumn();
        }
    }

?>