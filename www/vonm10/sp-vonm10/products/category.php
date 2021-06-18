<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php require_once __DIR__ . '/../db/CategoriesDB.php'; ?>
<?php
$categoryId = $_GET['categoryId'];
$productsDB = new ProductsDB();
$products = $productsDB->fetchByCategory($categoryId);

$categoriesDB = new CategoriesDB();
$category = $categoriesDB->fetch($categoryId);
?>



<?php require __DIR__ . '/../incl/header.php'; ?>
<div class="col-lg-3">
    <h1 class="my-4"> <?php echo $category['name']; ?></h1>
    <?php require __DIR__ . '/../components/CategoryDisplay.php'; ?>
</div>
<div class="col-lg-9" style = "text-align: center;">
    <?php require __DIR__ . '/../components/ProductDisplay.php'; ?>
</div>

<?php require __DIR__ . '/../incl/footer.php'; ?>