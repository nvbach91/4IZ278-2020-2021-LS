<?php
session_start();

require_once __DIR__ . '/model/ProductsDB.php';
require_once __DIR__ . '/model/Cart.php';

$ids = @$_SESSION['cart'];

if (is_array($ids) && count($ids)) {
    $cart = new Cart($ids);
    $products = $cart->getProducts();
    $sum = $cart->getCartTotal();
} else {
    $products = [];
    $sum = 0;
}
?>



<?php
//head
include "includes/head.php";
//Navigation
include "includes/navigation.php"
?>
<main class="container">
    <h1 class="text-center mb-3 mt-5">My shopping cart</h1>
    Total goods selected: <?= @count($products) ?>
    Total price  <?= $sum?>
    <br><br>
    <a href="index.php">Back to the product list!</a>
    <br><br>
    <?php if (@$products): ?>
        <div class="cart-products mb-5">
            <?php foreach ($products as $product): ?>
                <div class="card product" style="width: calc(100% / 3)">
                    <img class="card-img-top" src="public/img/<?php echo $product['img'] ?>"
                         alt="<?php echo $product['name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name'] ?></h5>
                        <div class="card-subtitle"><?php echo $product['price'] ?></div>
                        <div class="card-text"><?php echo $product['made_in'] ?></div>
                        <form action="remove-item.php" method="POST">
                            <input class="d-none" name="id" value="<?php echo $product['product_id'] ?>">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <h5>No goods yet</h5>
    <?php endif; ?>
</main>


<?php
//Footer
include "includes/footer.php";
//Foot
include "includes/foot.php";
?>
