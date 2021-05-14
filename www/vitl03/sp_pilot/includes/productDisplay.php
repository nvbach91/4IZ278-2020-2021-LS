<?php require __DIR__ . '/../class/ProductsDB.php'; ?>
<?php

$productsDB = new ProductsDB();
$products = $productsDB->fetchAll();



$nItemsInDatabase = $productsDB->fetchNumberOfProducts();
$nPaginations = ceil($nItemsInDatabase / ITEMS_PER_PAGINATION);

?>
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
<!-- section title -->
<div class="col-md-12">
    <div class="section-title">
        <h3 class="title">New Products</h3>
    </div>
</div>
<!-- /section title -->

        <!-- Products tab & slick -->
        <div class="row">

            <?php foreach ($products as $product) : ?>
                <div class="col-lg-3 col-md-6 mb-4">

                    <!-- product -->
                    <div class="product">
                        <div class="product-img">
                            <img src="<?php echo $product['img']; ?>" width="250" height="250" alt="img">
                            <div class="product-label">
                                <span class="sale">
                                <?php if(($product['discount'])!=0): ?>
                                <?php echo '-' . ($product['discount'])*100 . ' ' . "%"; ?></span>               
                                <?php endif;?>
                                <span class="new">NEW</span>
                            </div>
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#"><?php echo $product['name']; ?></a></h3>
                            <h4 class="product-price"><?php echo  (($product['price'])) . ' ' . CURRENCY; ?><del class="product-old-price"> <?php echo (round(($product['price']*(1+$product['discount'])),2)) . ' ' . CURRENCY; ?></del></h4>


                        </div>
                        <div class="add-to-cart">
                        <?php if (!isset($_SESSION['user_id'])): ?>
     
                                            <a class="add-to-cart-btn" href="signin.php">add to cart</a>
                                         <?php else: ?>
                                            <a class="add-to-cart-btn" href="buy.php?id=<?php echo $product['product_id'];?>">add to cart</a>
                                           
                                        <?php endif ?>
                      
                        </div>

                        <!-- /product -->


                    </div>

                </div>
                <!-- /tab -->

            <?php endforeach; ?>

            
        </div>
                <!-- row -->
                <div class="row">


    <div class="paginations">
        <?php for ($i = 1; $i <= $nPaginations; $i++) { ?>
            <a class="pagination pagination<?php echo ($offset / ITEMS_PER_PAGINATION) + 1 == $i ? ' active ' : ''; ?>" href="index.php?offset=<?php echo ($i - 1) * ITEMS_PER_PAGINATION; ?>">
                <?php echo $i; ?>
            </a>

        <?php } ?>

    </div>
</div>

    </div>
</div>