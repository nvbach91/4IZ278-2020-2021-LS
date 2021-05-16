<?php
require __DIR__ . '/../database/productsDB.php';

$productsDB = new ProductsDB();
$products = $productsDB->fetchAllOrderedBy([['name' => 'rating', 'order' => 'DESC'], ['name' => 'name']]);
?>

<?php foreach ($products as $product) : ?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <a href="#"><img class="card-img-top" src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>"></a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="#"><?php echo $product['name']; ?></a>
                </h4>
                <h5><?php echo number_format($product['price'], 2, ',', ' '), ' ', GLOBAL_CURRENCY; ?></h5>
                <?php if (isset($product['cat_name'])) : ?>
                    <h5 class="card-text"><?php echo $product['cat_name']; ?></h5>
                <?php endif; ?>
                <?php if (isset($product['description'])) : ?>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                <?php endif; ?>
            </div>
            <div class="card-footer">
                <small class="text-muted">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                        <?php echo $product['rating'] > $i ? '&#9733;' : '&#9734;' ?>
                    <?php endfor; ?>
                </small>
            </div>
        </div>
    </div>
<?php endforeach; ?>