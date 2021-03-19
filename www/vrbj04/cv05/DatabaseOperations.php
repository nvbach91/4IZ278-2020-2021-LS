<?php


namespace cv05;


interface DatabaseOperations
{
    public function create(array $parameters);

    public function fetch(int $id);

    public function save(int $id, array $parameters);

    public function delete(int $id);
}