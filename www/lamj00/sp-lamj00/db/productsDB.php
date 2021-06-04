<?php
require_once "Database.php";

class productsDB extends Database {
    public function __construct()
    {
        $this->tableName = "products";
        $this->init_database();
    }
}