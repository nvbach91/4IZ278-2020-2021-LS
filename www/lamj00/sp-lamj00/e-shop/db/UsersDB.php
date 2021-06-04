<?php
require_once "Database.php";


class UsersDB extends Database {
    public function __construct()
    {
        $this->tableName = "users";
        $this->init_database();
    }
}