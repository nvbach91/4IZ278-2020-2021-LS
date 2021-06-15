<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php require_once __DIR__ . '/../db/CategoriesDB.php'; ?>
<?php
$categoryId = $_GET['id'];
$productsDB = new ProductsDB();
$products = $productsDB->fetchByCategory($categoryId);

$categoriesDB = new CategoriesDB();
$category = $categoriesDB->fetch($categoryId);
?>



<?php require __DIR__ . '/../incl/header.php'; ?>
<h1 class="card-title"> <?php echo $category['name']; ?></h1>
<div class="col-lg-9">
    <?php require __DIR__ . '/../components/ProductDisplay.php'; ?>
</div>

<?php require __DIR__ . '/../incl/footer.php'; ?>