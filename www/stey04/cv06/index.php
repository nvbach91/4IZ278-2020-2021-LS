<?php require __DIR__ . '/db.php'; ?>
<?php include __DIR__ . '/includes/header.php' ?>
<div class="container">
    <div class="row">
        <?php include __DIR__ . '/includes/categories.php' ?>
        <div class="col-lg-9">
            <?php include __DIR__ . '/includes/slides.php' ?>
            <?php include __DIR__ . '/includes/products.php' ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/includes/footer.php' ?>