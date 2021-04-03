<?php require __DIR__ . '/../database/ProductsDB.php'; ?>
<?php
$productsDB = new ProductsDB();
$products = $productsDB->fetchAll();
?>

<div class="row">
    <?php foreach($products as $product): ?>
        <div class="col-lg-3 col-md-3 mb-3">
            <div class="text-center card h-100">
                <a href="#"><img class="product-image" src="<?php echo $product['image']; ?>" alt="ProductsDB.php-product-image"></a>
                <div class="card-body">
                    <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
                    <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
                    <p class="card-text"><?php echo 'Lorem ipsum dolor amet sungo motte balu kareso loqes'; ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- /.row -->