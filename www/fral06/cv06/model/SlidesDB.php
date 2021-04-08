<?php

require_once __DIR__ . '/Database.php';

class SlidesDB extends Database
{
    public function fetch()
    {
        $sql = "SELECT * FROM Slides";
        $statement = $this->db->prepare($sql);
        $statement->execute();

        $results = $statement->fetchAll();
        return $results;
    }
}