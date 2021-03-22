<?php

interface DatabaseOperations
{
    public function fetch();
    public function create($args);
    public function update($id, $args);
    public function delete($id);
}
