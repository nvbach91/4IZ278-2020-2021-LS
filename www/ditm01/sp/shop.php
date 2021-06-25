<?php require __DIR__ . '/db/productsDB.php'; ?>
<?php require __DIR__ . '/db/categoriesDB.php'; ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
$productsDB = new ProductsDB();
$categoriesDB = new CategoriesDB();

$nItems = 9;
$categories = $categoriesDB->fetchAll();

if (isset($_GET['category'])) {
    $id = $_GET['category'];
    $categories_id = $categoriesDB->fetchId($id);
    if ($categories_id == NULL) {
        header("Location: 404");
    }
}

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

if (isset($_GET['category'])) {
    $Category_id = $_GET['category'];
    $numberOfproducts = $productsDB->countCategoryProducts($Category_id);
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
    $Category_id = $_GET['category'];
    $products = $productsDB->fetchCategoryProducts($Category_id, $nItems, $offset);
} else {
    $products = $productsDB->fetchAllProducts($nItems, $offset);
}

$current =  $_SERVER['REQUEST_URI'];
$_SESSION['shop_url'] = $current;
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <div class="row g-3">
        <div class="col-md-4 col-lg-3 col-xl-2">
            <div class="list-group">
                <?php foreach ($categories as $category) : ?>
                    <a href="shop?category=<?php echo $category['id'] ?>" class="list-group-item list-group-item-action <?php echo isset($_GET['category']) && $_GET['category'] == $category['id']  ? ' active' : '' ?>"><?php echo $category['name']; ?></a>
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