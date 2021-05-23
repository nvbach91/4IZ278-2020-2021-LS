<?php require __DIR__ . '/../class/ProductsDB.php'; ?>


<?php

$productsDB = new ProductsDB();


$nItemsPerPagination = 6;

$nItemsInDatabase = $productsDB->fetchNumberOfProducts();
$nPaginations = ceil($nItemsInDatabase / $nItemsPerPagination);

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}


$products = $productsDB->fetchAllPagination($nItemsPerPagination,$offset);




?>
<div class="section">
    <div class="container">
        <div class="col-md-12">
            <div class="section-title">
                <h3 class="title">New Products</h3>
            </div>
        </div>

        <div class="row">

            <?php foreach ($products as $product) : ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <form method="post" action="index.php?page=cart">
                        <div class="product">
                            <div class="product-img">
                                <a href="index.php?page=product&id=<?= $product['product_id'] ?>"><img src="img/<?php echo $product['name']; ?>.png" width="250" height="250" alt="img"></a>
                                <div class="product-label">
                                    <span class="sale">
                                        <?php if (($product['discount']) != 0) : ?>
                                            <?php echo '-' . ($product['discount']) * 100 . ' ' . "%"; ?></span>
                                <?php endif; ?>
                                <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body">

                                <h3 class="product-name"><a href="index.php?page=product&id=<?= $product['product_id'] ?>"><?php echo $product['name']; ?></a></h3>
                                <h4 class="product-price"><?php echo (($product['price'])) . ' ' . CURRENCY; ?><del class="product-old-price">

                                        <?php if ($product['discount'] > 0) {
                                            echo (round(($product['price'] * (1 + $product['discount'])), 2)) . ' ' . CURRENCY;
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


        </div>
        <div class="row">




            <div class="paginations">
                    <?php for ($i = 1; $i <= $nPaginations; $i++) { ?>
                <a class="pagination pagination<?php echo $offset / $nItemsPerPagination + 1 == $i ? " active " : ""; ?>" href="home.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
                    <?php echo $i; ?>
                </a>
            <?php } ?>

            </div>
        </div>

    </div>
    <script type="text/javascript">
        document.getElementById('quantity_default').value = '1';
    </script>
</div>