<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>
<body>
<?php include __DIR__ . '/lib/database.php'; ?>
<?php include __DIR__ . '/lib/orders.php'; ?>
<?php include __DIR__ . '/lib/products.php'; ?>
<?php include __DIR__ . '/lib/users.php'; ?>
</head>
<h1>Users:</h1>
<pre>
<?php 
$usersDb = new UsersDB();
$usersDb->create(['id'=>1, 'name'=>'Mariola']); 
$usersDb->create(['id'=>2, 'name'=>'Jakub']); 
$usersDb->save(1, ['id'=>1, 'name'=>'Daniela']);
$usersDb->delete(1);
$usersDb->fetch();
?>
</pre>

<h1>Products:</h1>
<pre>
<?php 
$productsDb = new ProductsDB();
$productsDb->create(['id'=>1, 'name'=>'shirt']); 
$productsDb->create(['id'=>2, 'name'=>'trousers']); 
$productsDb->save(1, ['id'=>1, 'name'=>'dress']);
$productsDb->delete(1);
$productsDb->fetch();
?>
</pre>

<h1>Orders:</h1>
<pre>
<?php 
$ordersDb = new OrdersDB();
$ordersDb->create(['id'=>1, 'value'=>1000]); 
$ordersDb->create(['id'=>2, 'value'=>1500]); 
$ordersDb->save(1, ['id'=>1, 'value'=>2000]);
$ordersDb->delete(1);
$ordersDb->fetch();
?>
</pre>

</body>
</html>


