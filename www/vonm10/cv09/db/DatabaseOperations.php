<?php

interface DatabaseOperations
{
    public function fetchAll();
    public function fetch($id);
    public function add($name, $price, $img);
    public function update($id, $name, $price, $img);
    public function delete($id);

    public function addUser($email, $password);
    public function updateRole($id, $newRole);
}
