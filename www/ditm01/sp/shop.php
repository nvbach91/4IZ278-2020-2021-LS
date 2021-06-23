<?php require __DIR__ . '/db/productsDB.php'; ?>
<?php require __DIR__ . '/db/categoriesDB.php'; ?>
<?php
$productsDB = new ProductsDB();
$categoriesDB = New CategoriesDB();

$nItems = 9;
$categories = $categoriesDB->fetchAll();

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset']; 
} else {
    $offset = 0;
}

if (isset($_GET['category'])) {
    $nameCategory = $_GET['category'];
    $numberOfproducts = $productsDB->countCategoryProducts($nameCategory);
} else {
    $numberOfproducts = $productsDB->countAllProducts();
}
$numberOfPaginations = ceil($numberOfproducts / $nItems);

if (isset($_GET['category'])) {
    $selectedCategory = 'category=' . $_GET['category'] . '&';
} else {
    $selectedCategory = '';
}

if (isset($_GET['category'])) {
    $nameCategory = $_GET['category'];
    $products = $productsDB->fetchCategoryProducts($nameCategory, $nItems, $offset);
} else {
    $products = $productsDB->fetchAllProducts($nItems, $offset);
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <div class="row g-3">
        <div class="col-md-4 col-lg-3 col-xl-2">
            <div class="list-group">
                <?php foreach ($categories as $category) : ?>
                    <a href="shop.php?category=<?php echo $category['name'] ?>" class="list-group-item list-group-item-action <?php echo isset($_GET['category']) && $_GET['category'] == $category['name']  ? ' active' : '' ?>"><?php echo $category['name']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-8 col-lg-9 col-xl-10">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                <?php include __DIR__ . '/components/productCart.php'; ?>
            </div>
        </div>
        <ul class="pagination justify-content-center">
            <?php include __DIR__ . '/components/pagination.php'; ?>
        </ul>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>