<?php include './includes/header.php' ?>
<pre>
<?php
require_once './database.php';
$users = new UsersDB();
$users->create(['id' => 1, 'name' => 'Tomas', 'age' => 45]);
$users->create(['id' => 2, 'name' => 'Jiri', 'age' => 28]);
$users->create(['id' => 3, 'name' => 'Anna', 'age' => 35]);
$users->fetch(['id' => 3]);
$users->fetch(['id' => 2]);
$users->fetch(['id' => 1]);
$users->update(['id' => 1, 'name' => 'Tomas', 'age' => 55]);
$users->fetch(['id' => 1]);
$users->delete(['id' => 3]);
$users->fetch(['id' => 3]);

$products = new ProductsDB();
$products->create(['id' => 1, 'name' => 'Nails', 'price' => 5]);
$products->create(['id' => 2, 'name' => 'Wood', 'price' => 25]);
$products->create(['id' => 3, 'name' => 'Glass', 'price' => 50]);
$products->fetch(['id' => 3]);
$products->fetch(['id' => 2]);
$products->fetch(['id' => 1]);
$products->update(['id' => 1, 'name' => 'Nails', 'price' => 10]);
$products->fetch(['id' => 1]);
$products->delete(['id' => 3]);
$products->fetch(['id' => 3]);

$orders = new OrdersDB();
$orders->create(['id' => 1, 'date' => '2020-01-01', 'price' => 1000]);
$orders->create(['id' => 2, 'date' => '2020-03-05', 'price' => 2500]);
$orders->create(['id' => 3, 'date' => '2018-10-12', 'price' => 6666]);
$orders->fetch(['id' => 3]);
$orders->fetch(['id' => 2]);
$orders->fetch(['id' => 1]);
$orders->update(['id' => 1, 'date' => '2020-01-01', 'price' => 999]);
$orders->fetch(['id' => 1]);
$orders->delete(['id' => 3]);
$orders->fetch(['id' => 3]);
?>
</pre>
<?php include './includes/footer.php' ?>