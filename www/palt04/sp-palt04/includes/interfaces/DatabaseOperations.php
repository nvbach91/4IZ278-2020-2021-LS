<?php

interface DatabaseOperations
{
    public function fetchAll();
    public function fetchBy($params);
    public function create($params);
    public function update($params);
    public function delete($params);
}