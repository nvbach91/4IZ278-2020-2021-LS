<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testing OOP DB</title>
</head>

<body>
    <p>OOP - DATABASE</p>
    <pre class="prettyprint lang-php">

<?php
require_once './includes/interfaces/DatabaseOperations.php';
require_once './includes/classes/Database.php';
require_once './includes/classes/OrdersDB.php';
require_once './includes/classes/ProductsDB.php';
require_once './includes/classes/UsersDB.php';

echo PHP_EOL;

$users = new UsersDB();
$users->create(['name' => 'Luke', 'email' => 'test@test.cz', 'age' => '69']);
$users->fetch(['id' => 0]);
echo PHP_EOL;

$products = new ProductsDB();
$products->create(['name' => 'RTX3080', 'price' => 3333]);
$products->fetch(['id' => 0]);
echo PHP_EOL;


$orders = new OrdersDB();
$orders->create(['number' => 42, 'total' => 1042.5]);
$orders->fetch(['id' => 0]);
echo PHP_EOL;

echo $orders, PHP_EOL;
?>
</pre>
    <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
</body>

</html>