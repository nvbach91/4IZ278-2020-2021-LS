<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>

<main class="container-fluid">
    <div class="row">
        <div class="col-lg-xl-12 slide-display">
            <?php require __DIR__ . '/components/slideDisplay.php'; ?>
        </div>
        <div class="col-lg-12">
            <?php require __DIR__ . '/components/categoryDisplay.php'; ?>
        </div>
        <div class="row products-row">
            <div class="col-lg-12 products" id="shop">
                <?php require __DIR__ . '/components/productDisplay.php'; ?>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>