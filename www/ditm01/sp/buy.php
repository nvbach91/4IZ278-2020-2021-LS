<?php require __DIR__ . '/db/productsDB.php'; ?>
<?php 
if(!isset($_SESSION)){
    session_start();
}

$productsDB = New ProductsDB();

if (!@$_SESSION['cart']) {
    $_SESSION['cart'] = [];
}

$id = $_GET['id'];
$product = $productsDB->findProduct($id);
if (!$product) {
    exit('Items not found');
}

array_push($_SESSION['cart'], $product['id']);

header('Location: cart.php');
?>