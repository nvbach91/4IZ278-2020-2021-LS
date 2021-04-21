<?php require __DIR__ . '/class/ProductsDB.php'; ?>
<?php


$productsDB = new ProductsDB();
$success = $productsDB->create();
$errors = $productsDB->getErrors();

?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php require __DIR__ . '/includes/navigation.php'; ?>

<body>
    <div class="container" style="margin-bottom: 200px;">

        <h1 style="margin-top:20px;">Create a product</h1>

        <ul>
            <?php foreach ($errors as $error) :?>
                <div class="alert-danger"><?php echo $error; ?></div>
            <?php endforeach;  ?>
            <?php if ($success) :?>
                <div class="alert-success">You have successfully created an item</div>
            <?php endif; ?>
        </ul>

        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" id="name" name="name" placeholder="name">
                <label>Price</label>
                <label ></label><input class="form-control" id="price" name="price" placeholder="price" >
                <label>Image</label>
                <label ></label><input class="form-control" id="img" name="img" placeholder="url" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

    <?php include __DIR__ . '/includes/footer.php' ?>