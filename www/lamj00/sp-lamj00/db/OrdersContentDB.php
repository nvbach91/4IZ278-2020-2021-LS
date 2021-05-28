<?php
require_once "Database.php";

class ordersContentDB extends Database
{
    public function __construct()
    {
        $this->tableName = "orders_content";
        $this->init_database();
    }
}