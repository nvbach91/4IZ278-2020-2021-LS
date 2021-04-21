<?php require __DIR__ . '/../class/ProductsDB.php'; ?>
<?php

$productsDB = new ProductsDB();
$products = $productsDB->fetchAll();


$nItemsInDatabase = $productsDB->fetchNumberOfProducts();
$nPaginations = ceil($nItemsInDatabase / ITEMS_PER_PAGINATION);

?>


<div class="container">
    <h1 class="my-4">Fruit shop</h1>
    <div>Number of products in catalog: <?php echo $nItemsInDatabase; ?></div>
    <div>Number pagination: <?php echo $nPaginations; ?></div>
    <div class="paginations">
        <?php for ($i = 1; $i <= $nPaginations; $i++) { ?>
            <a class="pagination pagination<?php echo ($offset / ITEMS_PER_PAGINATION) + 1 == $i ? ' active ' : ''; ?>" href="index.php?offset=<?php echo ($i - 1) * ITEMS_PER_PAGINATION; ?>">
                <?php echo $i; ?>
            </a>

        <?php } ?>

    </div>


    <!-- /.col-lg-3 -->

    <div class="row">

        <?php foreach ($products as $product) : ?>
            <div class="col-lg-4 col-md-6 mb-4">

                <div class="card h-100">

                    <a href="#"><img class="class-img-top" src="<?php echo $product['img']; ?>" width="200" height="160" alt="img"></img></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <h4 class="productName"> <?php echo $product['name']; ?><h4>
                                </h4>
                                <h5> <?php echo $product['price'] . ' ' . CURRENCY; ?></h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                                <div class="card-controls">
                                         <a class="btn btn-success " href="buy.php?id=<?php echo $product['product_id']; ?>">Buy</a>
                                    <?php if (isset($_SESSION['user_id'])) : ?>
                                    <?php  if($_SESSION['user_privillage'] > 1 ) : ?>
                                         <a class="btn btn-warning " href="edit-item.php?id=<?php echo $product['product_id']; ?>">Edit</a>
                                    <a class="btn btn-outline-danger " href="delete.php?id=<?php echo $product['product_id']; ?>">Delete</a>
                                    <?php endif?>
                                    <?php endif?>
                                  


                                </div>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>




        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>