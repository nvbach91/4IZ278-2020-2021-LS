<?php

require_once  __DIR__ . "/Database.php";

class ProductsDB extends Database
{

    public function fetch()
    {
        $sql = "SELECT * FROM Products";
        $statement = $this->db->prepare($sql);
        $statement->execute();

        $results = $statement->fetchAll();
        return $results;
    }
}