<?php require __DIR__ . '/db/productsDB.php'; ?>
<?php
$productsDB = new ProductsDB();

$products = $productsDB->fetchNew();
$firstProducts = $productsDB->fetchDisplayProducts();
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <?php include __DIR__ . '/components/productDisplay.php'; ?>
    <div class="d-flex justify-content-center">
        <h2 class="mt-5 mb-3">New</h2>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-5">
        <?php include __DIR__ . '/components/productCart.php'; ?>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>