<?php require __DIR__ . '/class/ProductsDB.php'; ?>
<?php
session_start();
$productsDB = new ProductsDB();
$productsDB->delete();


?>
