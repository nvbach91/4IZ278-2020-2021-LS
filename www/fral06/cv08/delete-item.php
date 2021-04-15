<?php

require __DIR__ . "/model/ProductsDB.php";

$productDb = new ProductsDB();
$productId = $_GET['id'];

if(isset($productId) && $productId >= 0) {
   $productDb->deleteById($productId);
}

header('Location: index.php');
exit();
?>