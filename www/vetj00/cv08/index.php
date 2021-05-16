<?php require __DIR__ . '/includes/header.php' ?>
<?php require __DIR__ . '/includes/navigation.php' ?>


<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">Sharp glasses</h1>
            <?php require __DIR__ . '/components/categories.php' ?>
        </div>
        <div class="col-lg-9">
            <?php require __DIR__ . '/components/slider.php' ?>
            <div class="row">
                <?php require __DIR__ . '/components/products.php' ?>
            </div>
        </div>
    </div>
</div>


<?php require __DIR__ . '/includes/footer.php' ?>