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

        // public function fetchByUser($userID) {
        //     $sql = "SELECT *
        //         FROM orders INNER JOIN users ON users.user_id=orders.user_id 
        //         WHERE orders.user_id=$userID";
        //     $statement = $this->pdo->prepare($sql);
        //     $statement->execute();

        //     return $statement->fetchAll();

            
        // }

        public function fetchByUser($userID) {
            $sql = "SELECT * 
                FROM orders 
                JOIN users ON (orders.user_id = users.user_id)
                JOIN ordersproducts ON (orders.order_id = ordersproducts.order_id) 
                JOIN products ON (ordersproducts.product_id = products.product_id) 
                WHERE orders.user_id=$userID" ;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll();
        }

        public function fetchOneByOrder($userID, $orderID) {
            $sql = "SELECT *
                FROM orders 
                JOIN users ON (orders.user_id = users.user_id)
                JOIN ordersproducts ON (orders.order_id = ordersproducts.order_id) 
                JOIN products ON (ordersproducts.product_id = products.product_id) 
                WHERE orders.user_id=$userID AND orders.order_id=$orderID" ;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            return $statement->fetch();
        }

        public function fetchByOrder($userID, $orderID) {
            $sql = "SELECT *
                FROM orders 
                JOIN users ON (orders.user_id = users.user_id)
                JOIN ordersproducts ON (orders.order_id = ordersproducts.order_id) 
                JOIN products ON (ordersproducts.product_id = products.product_id) 
                WHERE orders.user_id=$userID AND orders.order_id=$orderID" ;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll();

            
        }
    }

?>