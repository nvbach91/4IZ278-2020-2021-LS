<?php

require __DIR__ . '/./Database.php';

class CategoriesDB extends Database
{

    public function fetch()
    {

        $sql = "SELECT * FROM Categories";
        $statement = $this->db->prepare($sql);
        $statement->execute();

        $results = $statement->fetchAll();
        return $results;
    }
}