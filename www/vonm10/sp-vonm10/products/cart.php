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
                <div><a href = "<?php echo URL . '/products/product.php?id=' . $product['id'] ?>"><?php echo $product['name'] . '(id=' . $product['id'] . ')'; ?></a></div>
                <div>Price: <?php echo $product['price'] ?></div>
                <div><a href="remove-item.php?id=<?php echo $product['id']; ?>">Remove from cart</a></div>
            </li>
            <hr>
            <?php $totalPrice = $totalPrice + $product['price'] ?>
        <?php endforeach ?>
    </ul>
    <div>Price total: <?php echo $totalPrice ?></div>
    <?php $_SESSION['totalPrice'] = $totalPrice; ?>
    <? if(isset($_SESSION['login']) && $_SESSION['login']==true) : ?>
    <div>
        <a href="payment.php">Select payment and delivery method</a>
    </div>
    <? else : ?>
    <div>You have to be logged in to continue</div>
    <div><a href="https://eso.vse.cz/~vonm10/beardwithme/login.php">Login</a></div>
    <div><a href="https://eso.vse.cz/~vonm10/beardwithme/registration.php">Or register</a></div>
<? endif; ?>
<? else : ?>
    <div>Your cart is empty</div>
    <div><a href="https://eso.vse.cz/~vonm10/beardwithme/index.php">Back to store</a></div>
<? endif; ?>

<?php require __DIR__ . '/../incl/footer.php'; ?>