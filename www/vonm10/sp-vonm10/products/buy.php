<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$id = $_GET['id'];
$productsDB = new ProductsDB();
$product = $productsDB->fetch($id);

if (!$product) {
    header('Location: https://eso.vse.cz/~vonm10/beardwithme/index.php');
    exit();
} else {
    if (!in_array($id, $_SESSION['cart'])) {
        array_push($_SESSION['cart'], $id);
        header('Location: cart.php');
    } else {
        header('Location: cart.php');
    }
}

?>
