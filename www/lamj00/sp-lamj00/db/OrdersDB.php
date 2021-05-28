<?php
require_once "Database.php";

class OrdersDB extends Database {
    public function __construct()
    {
        $this->tableName = "orders";
        $this->init_database();
    }
}