<?php
require_once __DIR__ . '/includes/classes/ProductsDB.php';
require_once __DIR__ . '/includes/classes/Cart.php';

$cart = new Cart();

if (isset($_POST['action']) && isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['action'] == "addToCart") {
    $cart->addToCart($_POST['id']);
    array_push($cartMsgs, "Produkt byl přidán do košíku");
} elseif (isset($_POST['action']) && isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['action'] == "removeFromCart") {
    $cart->removeFromCart($_POST['id']);
    array_push($cartMsgs, "Produkt byl z košíku odebrán");
}

$cartProducts = $cart->getProducts();

?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarCart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Košík
    </a>
    <div class="dropdown-menu px-2" aria-labelledby="navbarCart">
        <?php foreach ($cartProducts as $cartKey => $cartProduct) : ?>
            <div class="row mb-1">
                <div class="col-8 pt-1">
                    <?php echo $cartProduct['name']; ?>
                </div>
                <div class="col-4">
                    <form method="post">
                        <input type="hidden" name="action" value="removeFromCart">
                        <input type="hidden" name="id" value="<?php echo $cartKey; ?>">
                        <input type="submit" class="btn btn-sm btn-danger" value="x">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="dropdown-divider"></div>
        <div class="text-right">
            <?php echo number_format($cart->getCartTotal(), 0, ".", " ") . " " . CURRENCY; ?>
        </div>
    </div>
</li>
