<?php
require_once "Database.php";


class usersDB extends Database {
    public function __construct()
    {
        $this->tableName = "users";
        $this->init_database();
    }
}