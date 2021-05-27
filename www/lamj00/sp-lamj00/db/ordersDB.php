<?php
require_once "Database.php";

class ordersDB extends Database {
    public function __construct()
    {
        $this->tableName = "orders";
        $this->init_database();
    }
}