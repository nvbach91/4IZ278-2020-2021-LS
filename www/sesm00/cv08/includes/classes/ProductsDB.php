<?php
require_once __DIR__ . '/Database.php';

class ProductsDB extends Database
{
    protected $tableName = 'products';

    public function fetchAll()
    {
        return $this->readData();
    }

    public function fetchBy($params)
    {
        if (isset($params['skip'])) {
            return $this->readData($params['where'], $params['skip']);
        } else {
            return $this->readData($params['where']);
        }
    }

    public function fetchProductCount() {
        return $this->getValue("COUNT(id)");
    }

    public function create($params)
    {
        return $this->insertData($params);
    }

    public function update($data, $where)
    {
        return $this->updateData($data, $where);
    }

    public function delete($params)
    {
        return $this->deleteData($params);
    }
}