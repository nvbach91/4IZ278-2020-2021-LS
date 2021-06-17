<?php

interface DatabaseOperations
{
    public function fetchAll();
    public function fetch($id);
    public function fetchByCategory($categoryId);
    public function fetchByIds($id);
    public function add($name, $price, $img, $description, $category);
    public function update($id, $name, $price, $img, $description);
    public function delete($id);

    public function pessimisticUpdate($userId, $timestamp, $productId);

    public function addUser($email, $password);
    public function updateRole($id, $newRole);

    public function createOrder($userId, $productId, $timestamp, $delivery, $payment);
    public function fetchOrders($userId, $timestamp);
}