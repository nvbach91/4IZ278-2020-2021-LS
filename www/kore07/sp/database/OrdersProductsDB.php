<?php require_once __DIR__ . '/Database.php'; ?>
<?php

    class OrdersProductsDB extends Database {
        protected $tableName = 'ordersproducts';

        public function fetchAll() {
            $sql = 'SELECT * FROM ' . $this->tableName;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        }

        public function create($args) {
            $sql = 'INSERT INTO ' . $this->tableName . '(order_id, product_id) VALUES (:order_id, :product_id)';
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'order_id' => $args['order_id'], 
                'product_id' => $args['product_id'], 
            ]);
        }
    }

?>