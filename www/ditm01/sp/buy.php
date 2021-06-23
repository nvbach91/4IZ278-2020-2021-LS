<?php require __DIR__ . '/db/productsDB.php'; ?>
<?php 
if(!isset($_SESSION)){
    session_start();
}

$products = New ProductsDB();

if (!@$_SESSION['cart']) {
    $_SESSION['cart'] = [];
}

$id = $_GET['id'];
$good = $products->findProduct($id);
if (!$good) {
    exit('Items not found');
}

array_push($_SESSION['cart'], $good['id']);

header('Location: cart.php');
?>