<?php require __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
session_start();
# cart session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
# check if if exists
$productDB = new ProductsDB();
$id = $_GET['id'];
$products = $productDB->fetchById($id);
if (!$products) {
    exit("Unable to find goods!");
}
# add id to cart, only if it's not already there
$alreadyInCart = array_key_exists($id, $_SESSION['cart']);
if (!$alreadyInCart) {
    $_SESSION['cart'][$products["product_id"]] = "1"; // set pcs to 1
    header('Location: ../cart.php');
    exit();
} else {
    header('Location: ../cart.php');
    exit();
}
?> 