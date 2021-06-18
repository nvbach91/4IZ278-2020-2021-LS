<?php
require_once __DIR__ . '/Database.php';

class UsersDB extends Database
{

    protected $tableName = 'users';

    public function selectAll()
    {
        return $this->fetchAll();
    }

    public function selectBy($params)
    {
       return $this->fetchBy($params);
    }

    public function create($params)
    {
        return $this->createRecord($params);
    }

    public function update($params)
    {
        return $this->updateRecord($params);
    }

    public function delete($ids)
    {
        return $this->deleteRecord($ids);
    }
}