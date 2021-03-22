<?php

require_once './includes/DatabaseOperation.php';
require_once './classes/Database.php';
require_once './classes/OrdersDB.php';
require_once './classes/ProductsDB.php';
require_once './classes/UsersDB.php';


$users = new UsersDB();
echo '<br>';
$users->create(['id' => 1, 'name' => 'Lebron', 'age' => 15]);
echo '<br>';
$users->create(['id' => 2, 'name' => 'Michael', 'age' => 11]);
echo '<br>';
$users->fetch(['id' => 1]);
echo '<br>';
$users->update(['id' => 1,'name' => 'Luka', 'phone' => 20]);
echo '<br>';
$users->delete(['id' => 1]);
echo '<br>';
echo PHP_EOL;

echo '<br>';

$products = new ProductsDB();
echo '<br>';
$products->create(['id'=> 1, 'name' => 'Wood', 'price' => 25.0]);
echo '<br>';
$products->create(['id'=> 2, 'name' => 'Coal', 'price' => 38.0]);
echo '<br>';
$products->fetch(['id' => 1]);
echo '<br>';
$products->update(['id' => 1, 'name' => 'Iron', 'price' => 120.0]);
echo '<br>';
$products->delete(['id' => 1]);
echo '<br>';
echo PHP_EOL;

echo '<br>';

$orders = new OrdersDB();
echo '<br>';
$orders->create(['id' => 42, 'total' => 10.7, 'date' => '2019-03-08']);
echo '<br>';
$orders->fetch(['id' => 42]);
echo '<br>';
$orders->update(['id' => 42, 'total' => 15, 'date' => '2018-03-08']);
echo '<br>';
$orders->delete(['id' => 42]);
echo '<br>';
$orders->create(['id' => 43, 'total' => 100.0, 'date' => '2018-03-08']);

echo '<br>';
echo $orders, PHP_EOL;
?>

