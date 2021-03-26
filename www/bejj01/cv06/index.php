<?php require __DIR__ . '/includes/header.php' ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">Super Knihy</h1>
            <h3 class="mt-5 text-light">Žánry:</h3>
            <?php require __DIR__ . '/components/categoriesDisplay.php' ?>
        </div>
        <div class="col-lg-9">
            <?php require __DIR__ . '/components/slideDisplay.php' ?>
            <hr class="bg-white">
            <div class="row">
                <?php require __DIR__ . '/components/productsDisplay.php' ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container -->

<?php require __DIR__ . '/includes/footer.php' ?>