<?php require __DIR__ . '/../ProductsDB.php'; ?>
<?php

$productsDB = new ProductsDB();
$products = $productsDB->fetchAll();

?>
<?php foreach ($products as $product) : ?>
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="card h-100">

            <a href="search.php?id=<?php echo $product['product_id']; ?>"><img class="class-img-top" src="<?php echo $product['img']; ?>" width="200" height="160" alt="img"></img></a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="search.php?id=<?php echo $product['product_id']; ?>"> <?php echo $product['name']; ?></a>
                </h4>
                <h5> <?php echo $product['price'] . ' ' . CURRENCY; ?></h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                <a class="btn btn-info" href="search.php?id=<?php echo $product['product_id']; ?>">Search this product</a>

            </div>

        </div>

    </div>
<?php endforeach; ?>