<?php
require_once"Database.php";


class CategoriesDB extends Database {
    public function __construct()
    {
        $this->tableName = "categories";
        $this->init_database();
    }
}