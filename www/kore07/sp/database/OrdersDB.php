<?php require_once __DIR__ . '/Database.php'; ?>
<?php

    class OrdersDB extends Database {
        protected $tableName = 'orders';

        public function fetchAll() {
            $sql = 'SELECT * FROM ' . $this->tableName;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        }

        public function create($args) {
            $sql = 'INSERT INTO ' . $this->tableName . '(order_date, order_delivery, order_payment, order_total, user_id) VALUES (:order_date, :order_delivery, :order_payment, :order_total, :user_id)';
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'order_date' => $args['date'], 
                'order_delivery' => $args['delivery'], 
                'order_payment' => $args['payment'],
                'order_total' => $args['total'],
                'user_id' => $args['user_id'],
            ]);
        }

        public function findLastID() {
            $sql = 'SELECT LAST_INSERT_ID()';
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            $lastId = $statement->fetchColumn();

            return $lastId;
        }
    }

?>