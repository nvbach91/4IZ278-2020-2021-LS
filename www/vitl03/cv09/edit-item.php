<?php session_start(); ?>
<?php require __DIR__ . '/class/ProductsDB.php'; ?>
<?php


$productsDB = new ProductsDB();
$productsDB->update();
$client= $productsDB->getClientInfo();
?>


<?php include __DIR__ . '/includes/header.php' ?>
<?php require __DIR__ . '/includes/navigation.php'; ?>
    <body>
        <div class="container" style="margin-bottom: 200px;">
        <h1 style="margin-top:20px;">Update item</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" id="name" name="name" value="<?= $client['name']?>"/>
                <label for="price">Price</label>
                <input class="form-control" id="price" name="price" value="<?= $client['price']?>"/>
                <label for="name">Img</label>
                <label for="img"></label><input class="form-control" id="img" name="img" value="<?= $client['img']?>"/>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        <?php include __DIR__ . '/includes/footer.php' ?>