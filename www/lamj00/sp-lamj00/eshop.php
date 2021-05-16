<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/productsDB.php";
require_once "db/categoriesDB.php";

if (isset($_GET['offset'])) {
    $currentPagination = (int) $_GET['offset'];
} else {
    $currentPagination = 1;
}
if (isset($_GET['category'])) {
    $cat = $_GET['category'];
} else {
    $cat = -1;
}
//fetches products
$prodDB = new productsDB();
$products = $prodDB -> fetchSome(0,3);
$productsPerPage = 9;
$numberOfPaginations = ceil(sizeOf($products) /$productsPerPage);

//gets category name

?>
<main class="container" style="text-align:center">
    <H1>E-shop</H1>
    <div class="row">
        <div class="col-lg-2">
            <?php require __DIR__ . '/components/CategoryDisplay.php'; ?>
        </div>
        <div class="col-lg-9">
            <?php require __DIR__ . '/components/PaginationDisplay.php'; ?>

            <?php require __DIR__ . '/components/ProductDisplay.php'; ?>
        </div>
    </div>
</main>
<?php
require  "incl/footer.php";
?>


