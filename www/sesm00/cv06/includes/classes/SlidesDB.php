<?php

class SlidesDB extends Database {

    protected $tableName = 'slides';

    public function fetchAll()
    {
        return $this->readDatabase();
    }

    public function fetchBy($params)
    {
        // TODO: Implement fetchBy() method.
    }

    public function create($params)
    {
        // TODO: Implement create() method.
    }

    public function update($params)
    {
        // TODO: Implement update() method.
    }

    public function delete($params)
    {
        // TODO: Implement delete() method.
    }

}