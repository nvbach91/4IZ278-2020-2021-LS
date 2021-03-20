<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Database</title>
</head>

<body>
    <pre>
    <?php

    require_once './includes/interfaces/DatabaseOperations.php';
    require_once './includes/classes/Database.php';
    require_once './includes/classes/OrdersDB.php';
    require_once './includes/classes/ProductsDB.php';
    require_once './includes/classes/UsersDB.php';

    echo PHP_EOL;


    $users = new UsersDB();
    $users->create(['name' => 'Dave', 'permission' => 'Read', 'phone' => '123456987']);
    $users->create(['name' => 'Michael', 'permission' => 'Write', 'phone' => '456789132']);
    $users->fetch(['id' => 1]);
    $users->update(['id' => 1, 'user' => ['name' => 'Dave', 'permission' => 'Read', 'phone' => '123456789']]);
    $users->delete(['id' => 0]);
    echo PHP_EOL;

    $products = new ProductsDB();
    $products->create(['name' => 'Melon', 'price' => 4500.0, 'priceTag' => '$']);
    $products->create(['name' => 'Banana', 'price' => 7690.0, 'priceTag' => 'CZK']);
    $products->fetch(['id' => 0]);
    $products->update(['id' => 0, 'product' => ['name' => 'Kokos', 'price' => 4500.0, 'priceTag' => '$']]);
    $products->delete(['id' => 1]);
    echo PHP_EOL;


    $orders = new OrdersDB();
    $orders->create(['number' => 42, 'total' => 1042.5, 'tax' => 20.3]);
    $orders->fetch(['id' => 0]);
    $orders->update(['id' => 0, 'order' => ['number' => 42, 'total' => 1000.5, 'tax' => 20.3]]);
    $orders->delete(['id' => 0]);
    $orders->create(['number' => 43, 'total' => 100.0, 'tax' => 21.0]);
    echo PHP_EOL;

    echo $orders, PHP_EOL;

    ?>
    </pre>
</body>
</html>