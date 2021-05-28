<?php require_once __DIR__ . '/class/ProductsDB.php'; ?>

<?php

$productsDB = new ProductsDB();


if (isset($_GET['search'])) {
    $products = $productsDB->searchProduct(htmlspecialchars($_GET['search']));
}



$nItemsInDatabase = $productsDB->fetchNumberOfProducts();
$nPaginations = ceil($nItemsInDatabase / 6);

?>
<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/navigationCategories.php' ?>
<div class="section">
    <div class="container">
        <div class="row">
            <?php if (empty($products)) : ?>
                <h2>No product or description matching your search was found.</h2>
            <?php else : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <form method="post" action="index.php?page=cart">
                            <div class="product">
                                <div class="product-img">


                                    <a href="index.php?page=product&id=<?= $product['product_id'] ?>"><img src="img/<?= $product['name']; ?>.png" width="250" height="250" alt="img"></a>
                                    <div class="product-label">
                                        <span class="sale">
                                            <?php if (($product['discount']) != 0) : ?>
                                                <?php echo '-' . ($product['discount']) * 100 . ' ' . "%"; ?></span>
                                    <?php endif; ?>
                                    <span class="new">NEW</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">
                                    </p>
                                    <h3 class="product-name"><a href="index.php?page=product&id=<?= $product['product_id'] ?>"><?php echo $product['name']; ?></a></h3>
                                    <h4 class="product-price"><?php echo (($product['price'])) . ' CZK'; ?><del class="product-old-price">

                                            <?php if ($product['discount'] > 0) {
                                                echo (round(($product['price'] * (1 + $product['discount'])), 2)) . ' CZK';
                                            } ?></del></h4>



                                    <input id="quantity_default" type="number" class="form-control" name="quantity" value="1" min="1" placeholder="Quantity" required>
                                    <input type="hidden" name="product_id" value="<?php echo $product["product_id"]; ?>">
                                    <input type="hidden" name="img" value="<? echo $product['img'] ?>">
                                    <input type="hidden" name="name" value="<?php echo $product["name"]; ?>">
                                    <input type="hidden" name="price" value="<?php echo $product["price"]; ?>">


                                    <div class="add-to-cart">
                                        <input type="submit" name="add" class="add-to-cart-btn" value="Add to Cart">
                                    </div>



                                </div>


                            </div>
                        </form>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>


        </div>
       


    </div>
</div>
<script type="text/javascript">
    document.getElementById('quantity_default').value = '1';
</script>

<?php include __DIR__ . '/includes/newsletter.php' ?>
<?php include __DIR__ . '/includes/footer.php' ?>