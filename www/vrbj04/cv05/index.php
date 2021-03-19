<?php

require __DIR__ . "/autoloader.php";

use cv05\implementations\OrdersDatabase;
use cv05\implementations\ProductsDatabase;
use cv05\implementations\UsersDatabase;

$users = new UsersDatabase();
$products = new ProductsDatabase();
$orders = new OrdersDatabase();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Database</title>
</head>
<body>
<h1>Users:</h1>
<code><pre>
<?= $users ?>
--------------
<?php
$users->create(["id" => 5, "name" => "Jirka", "surname" => "Vrba"]);
print_r($users->fetch(5) ?? "null\n");

$users->save(5, ["id" => 5, "name" => "something_else", "surname" => "also_this"]);
print_r($users->fetch(5) ?? "null\n");

$users->delete(5);
print_r($users->fetch(5) ?? "null\n");
?>
</pre>
</code>

<h1>Products</h1>
<code><pre>
<?= $products ?>
--------------
<?php
$products->create(["id" => 1, "description" => "Ice cream vanilla flavor"]);
print_r($products->fetch(1) ?? "null\n");

$products->save(1, ["id" => 1, "description" => "Another ice cream, this time chocolate one"]);
print_r($products->fetch(1) ?? "null\n");

$products->delete(1);
print_r($products->fetch(1) ?? "null\n");
?>
</pre>
</code>

<h1>Orders</h1>
<code><pre>
<?= $orders ?>
--------------
<?php
$orders->create(["id" => 4, "product_id" => 1, "customer_id" => 420, "note" => ""]);
print_r($orders->fetch(4) ?? "null\n");

$orders->save(4, ["id" => 4, "product_id" => 2, "customer_id" => 420, "note" => "Paid in advance"]);
print_r($orders->fetch(4) ?? "null\n");

$orders->delete(4);
print_r($orders->fetch(4) ?? "null\n");
?>
</pre>
</code>
</body>
</html>
