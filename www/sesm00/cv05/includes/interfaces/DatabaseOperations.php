<?php

interface DatabaseOperations
{
    public function fetch($args);
    public function create($args);
    public function update($args);
    public function delete($args);
}