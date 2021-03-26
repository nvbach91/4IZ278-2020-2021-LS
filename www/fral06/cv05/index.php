<?php

header('Content-Type: text/plain', true);


require 'db/UsersDB.php';
require 'db/ProductsDB.php';
require 'db/OrdersDB.php';

$users = new UsersDB(['id', 'name', 'age'], 'users');
echo $users->getConfig(), PHP_EOL;
$users->create(["id" => "1", 'name' => 'James', 'age' => '22']);
$users->create(["id" => "0", 'name' => 'Harry', 'age' => '28']);
$users->fetch();
$users->update("0", ["id" => "0", 'name' => 'Karel', 'age' => '28']);
$users->fetch();
$users->delete('0');
echo PHP_EOL;

$products = new ProductsDB(['id', 'name', 'price'], 'products');
echo $products->getConfig(), PHP_EOL;
$products->create(["id" => "1", 'name' => 'Car', 'price' => "333"]);
$products->create(["id" => "2", 'name' => 'Table', 'price' => "256"]);
$products->fetch();
echo PHP_EOL;

$orders = new OrdersDB(['id','user', 'product', 'date'], 'orders');
echo PHP_EOL;
echo $orders, PHP_EOL;
echo $orders->getConfig(), PHP_EOL;
$orders->create(['id' => '0', 'user' => '1', 'product' => '1', 'date' => '2012-12-29']);
$orders->fetch();
echo $orders, PHP_EOL;