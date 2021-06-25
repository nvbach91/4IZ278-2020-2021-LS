<?php require_once __DIR__ . '/database/ProductsDB.php'; ?>
<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productsDB = new ProductsDB();

    $products = [];
    $count = 0;
    $ids = [];

    foreach ($_SESSION['cart'] as $key=>$value) {
        array_push($ids, $_SESSION['cart'][$key]['id']);
    }

    if (is_array($ids) && count($ids)) {
        $question_marks = str_repeat('?,', count($ids) - 1) . '?';

        $products = $productsDB->fetchAllByOrder('product_id', $question_marks, $ids);
        $sum = $productsDB->fetchColumn('product_price * product_quantity', 'product_id', $question_marks, $ids);
        $count = $productsDB->fetchColumn('product_quantity', 'product_id', $question_marks, $ids);
    }
?>

<?php require __DIR__ . '/includes/header.php' ?>
<main class="container container--cart">
    <div class="main-container">
        <h1 class="main-heading">Shopping cart</h1>
    </div>
    <div class="cart-info_wrapper">
        <div class="main-container cart-info_wrapper--inner">
            <a class="cart-back_link" href="catalog.php">Back to products</a>
            <p class="cart-total_products"> Total products selected: <?php echo $count; ?> </p>
        </div>
    </div>
    <div class="main-container">
        <section class="cart">
            <h2 class="visually-hidden">Shopping cart</h2>
            <?php if ($products): ?>
                <div class="products-wrapper">
                    <table class="cart-table">
                    <?php foreach ($products as $product): ?>
                        <tr class="cart-tr">
                            <td class="cart-td cart-td--image"><img class="cart-image" src="<?php echo $product['product_img']; ?>"/></td>            
                            <td class="cart-td cart-td--name"><?php echo $product['product_name']; ?></td>            
                            <td class="cart-td cart-td--quantity"><?php echo $product['product_quantity']; ?></td>            
                            <td class="cart-td cart-td--price"><?php echo number_format($product['product_price'], 2), ' ', GLOBAL_CURRENCY; ?></td>            
                            <td class="cart-td cart-td--remove"><a class="cart-remove_link" href='components/removeItem.php?id=<?php echo $product['product_id']; ?>' aria-label="Remove"></a></td>            
                        </tr>
                        <?php endforeach; ?>
                        <tr class="cart-tr cart-tr--total">
                            <td class="cart-td"></td>
                            <td class="cart-td"></td>
                            <td class="cart-td cart-td--name cart-td--name_total">Total: </td>
                            <td class="cart-td cart-td--price"><strong><?php echo number_format($sum, 2), ' ', GLOBAL_CURRENCY; ?></strong></td>
                            <td class="cart-td"></td>
                        </tr>
                    </table>
                </div>
                <div class="cart_button-wrapper">
                    <a class="order-link button" href="order.php">Checkout</a>
                </div>
            <?php else: ?>
                <h2 class="cart-no_products_title">There is no products yet in the cart</h2>
                <p class="cart-back_main">Back to the <a class="cart-back_main_link" href="index.php">main page</a></p>
            <?php endif; ?>
        </section>
    </div>
</main>
<?php require __DIR__ . '/includes/footer.php' ?>
