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
$users->create(["name" => "Jirka", "surname" => "Vrba"]);
$users->fetch();
$users->save();
$users->delete();
?>
</pre>
</code>


<h1>Products</h1>
<code><pre>
<?= $products ?>
--------------
<?php
$products->create(["id" => "994671548", "description" => "Ice cream vanilla flavor"]);
$products->fetch();
$products->save();
$products->delete();
?>
</pre>
</code>

<h1>Orders</h1>
<code><pre>
<?= $orders ?>
--------------
<?php
$orders->create(["id" => "006481759", "customer_id" => "99706", "note" => "This is an order note smh."]);
$orders->fetch();
$orders->save();
$orders->delete();
?>
</pre>
</code>
</body>
</html>