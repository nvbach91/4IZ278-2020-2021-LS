<?php require __DIR__ . '/components/global.php'; ?>
<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php
session_start();
require 'components/userRequired.php';

$ids = @$_SESSION['cart'];

if (is_array($ids) && count($ids)) {
    $idsForSql = [];
    foreach ($ids as $key => $value) {
        array_push($idsForSql, $key);
    }
    $question_marks = str_repeat('?,', count($idsForSql) - 1) . '?';
    $productsDB = new ProductsDB();
    $productsFromDb = $productsDB->fetchCartProducts($question_marks, $idsForSql);
    $productsToShow = [];
    foreach ($productsFromDb as $product) {
        if (isset($ids[$product['product_id']])) {
            $product['product_pcs'] = $ids[$product['product_id']];
        }
        array_push($productsToShow, $product);
    }
    $_SESSION['productsToShow'] = $productsToShow; //needed for updating product pcs in cart, when changing pcs
    $productSums = [];
    foreach ($productsToShow as $product) {
        $productSum = $product['product_price'] * (int)$product['product_pcs'];
        array_push($productSums, $productSum);
    }
    $sum = array_sum($productSums);
} else {
    $sum = 0;
}

// amount of product in db
$productsDB = new ProductsDB();
function getProductPcs($productName)
{
    global $productsDB;
    $countPcs = $productsDB->fetchProductPcs($productName);
    return $countPcs;
}

function getProductPrice($productPrice, $productPcs)
{
    return $productPrice * (int)$productPcs;
}
?>

<?php include './incl/header.php' ?>
<?php include './incl/navbar.php' ?>
<main class="container cart">
    <h1 class="cart-headline">Your cart</h1>
    <div class="total-price">
        <div class="total-price-back-shopping">
            <a href="index.php"><i class="fas fa-arrow-left"></i> Back to shopping!</a>
            <h2 class="total-price">Total price: <span class="total-price-number"><?php echo htmlspecialchars($sum, ENT_QUOTES, 'UTF-8'); ?></span> <?php echo (GLOBAL_CURRENCY) ?></h2>
        </div>
        <?php if (@$sum > 0) : ?>
            <form action="components/startNewOrder.php">
                <button id="buy-btn" class="btn btn-primary btn-lg btn-cart-buy" type="submit">Buy</button>
            </form>
        <?php endif; ?>
    </div>
    <?php if (@$productsToShow) : ?>
        <div class="products">
            <?php foreach ($productsToShow as $row) : ?>
                <div class="card mb-3 cart-card" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $row['product_img']; ?>" alt="" class="cart-img">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                <h6 class="product-price"><?php echo htmlspecialchars(number_format(getProductPrice($row['product_price'], $row['product_pcs']), 0, '.', ''), ENT_QUOTES, 'UTF-8') ?> <?php echo (GLOBAL_CURRENCY) ?></h6>
                                <label for="inputPcs" class="form-label">Pieces:</label>
                                <input type="number" name="<?php echo $row['product_name'] ?>" class="form-control pcs-input" id="inputPcs" max="<?php echo getProductPcs($row['product_name']) ?>" min="1" value="<?php echo htmlspecialchars($row['product_pcs'], ENT_QUOTES, 'UTF-8') ?>">
                                <form action="components/removeItem.php" method="POST">
                                    <input class="d-none" name="id" value="<?php echo htmlspecialchars($row['product_id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <button type="submit" class="btn btn-danger btn-remove-item">Remove</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h5 class="color-white empty-cart">Your cart is empty :(</h5>
    <?php endif; ?>
</main>

<?php require './incl/footer.php'; ?>
<script src="js/cartPrices.js"></script>