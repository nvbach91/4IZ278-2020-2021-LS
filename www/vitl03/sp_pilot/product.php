<?php require __DIR__ . '/class/ProductsDB.php'; ?>

<?php
$productsDB = new ProductsDB();
$product = $productsDB->fetchByProd(htmlspecialchars($_GET['id']));




?>
<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/navigationCategories.php' ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="img/<?php echo $product['name']; ?>.png" width="400" height="400" alt="<?= $product['name'] ?>">
        </div>
        <div class="col-md-6 item">
            <div class="info-banner">
                <h1 class="name" style="text-transform:uppercase;"><?= $product['name'] ?></h1>
                <span class="price">
                    <?= $product['price'] ?> CZK
                    <del class="product-old-price"> <?php if ($product['discount'] > 0) {
                                                        echo (round(($product['price'] * (1 + $product['discount'])), 2)) . ' ' . "CZK";
                                                    } ?></del></h4>
                </span>

                <form action="index.php?page=cart" method="post">



                    <input type="number" name="quantity" value="1" min="1" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?php echo $product["product_id"]; ?>">
                    <input type="hidden" name="img" value="img/<?php echo $product['name']; ?>.png">
                    <input type="hidden" name="name" value="<?php echo $product["name"]; ?>">
                    <input type="hidden" name="price" value="<?php echo $product["price"]; ?>">

                    <div class="description">
                        <?php echo $product['desc'] ?>
                    </div>
                    <input class="secondary-btn" type="submit" value="Add To Cart">
                </form>
                <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_privilege'] > 2)) : ?>
                    <a style="text-align:center; text-transform:uppercase;" class="button-red" href="update.php?id=<?php echo $product['product_id']; ?>">Edit</a>
                    <a style="text-align:center; text-transform:uppercase; margin-top:5px;" class="button-red" href="delete.php?id=<?php echo $product['product_id']; ?>">Delete</a>


                <?php endif; ?>

            </div>
        </div>





    </div>
    <div style="margin-bottom:100px;"></div>
</div>


<?php include __DIR__ . '/includes/footer.php' ?>