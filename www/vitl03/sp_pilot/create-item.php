<?php require __DIR__ . '/class/ProductsDB.php'; ?>

<?php


$productsDB = new ProductsDB();
$success = $productsDB->create();
$errors = $productsDB->getErrors();

?>

<?php include __DIR__ . '/includes/header.php' ?>


<div class="container" style="margin-bottom: 200px;">
    <br>
    <a href="admin.php"><button style="margin-bottom:20px;" class="primary-btn">Back to Admin Panel</button></a>
    <h1 style="margin-top:20px;">Create a product</h1>

    <ul>
        <?php foreach ($errors as $error) : ?>
            <div class="alert-danger"><?php echo $error; ?></div>
        <?php endforeach;  ?>
        <?php if ($success) : ?>
            <div class="alert-success">You have successfully created an item</div>
        <?php endif; ?>
    </ul>

    <form method="POST">
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" id="name" name="name" placeholder="name">
            <label>Price</label>
            <label></label><input class="form-control" id="price" name="price" placeholder="price">
            <label>Discount</label>
            <label></label><input class="form-control" id="discount" name="discount" placeholder="discount">
            <label>Description</label>
            <label></label><input class="form-control" id="description" name="description" placeholder="description">
        </div>
        <button class="button-red" type="submit" style="text-transform:uppercase;">Create product</button>
    </form>

    <br>
    <div style="margin-bottom: 300px"></div>
</div>


<?php include __DIR__ . '/includes/newsletter.php' ?>

<?php include __DIR__ . '/includes/footer.php' ?>