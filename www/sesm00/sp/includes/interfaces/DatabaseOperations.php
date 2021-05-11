<?php

interface DatabaseOperations
{
    public function fetchAll();
    public function fetchBy($params);
    public function create($params);
    public function update($data, $where);
    public function delete($params);
}