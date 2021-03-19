<?php


namespace cv05;


interface DatabaseOperations
{
    public function create(array $parameters);

    public function fetch();

    public function save();

    public function delete();
}