<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php

session_start();

$date = time();

$productsDB = new ProductsDB();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if ($_SESSION) {
    if ($_SESSION['cart']) {
        if (count($_SESSION['cart']) >= 1) {
            $products = $productsDB->fetchByIds($_SESSION['cart']);
        } else {
            $products = [];
        }
    }
}



$totalPrice = 0;
?>

<?php require __DIR__ . '/../incl/header.php'; ?>
<h4 class="card-title">Cart</h4>
<hr>
<div><?php echo date("Y-m-d H:i:s", $date); ?></div>
<? if (count($_SESSION['cart']) >= 1) : ?>
    <ul>
        <?php foreach ($products as $product) : ?>
            <li>
                <div><?php echo $product['name'] . '(id=' . $product['id'] . ')'; ?></div>
                <div>Price: <?php echo $product['price'] ?></div>
                <div><a href="remove-item.php?id=<?php echo $product['id']; ?>">Remove from cart</a></div>
            </li>
            <hr>
            <?php $totalPrice = $totalPrice + $product['price'] ?>
        <?php endforeach ?>
    </ul>
    <div>Price total: <?php echo $totalPrice ?></div>
    <?php $_SESSION['totalPrice'] = $totalPrice; ?>
    <div>
        <a href="checkout.php">Checkout</a>
    </div>
<? else : ?>
    <div>Your cart is empty</div>
    <div><a href="https://eso.vse.cz/~vonm10/beardwithme/index.php">Back to store</a></div>
<? endif; ?>

<?php require __DIR__ . '/../incl/footer.php'; ?>