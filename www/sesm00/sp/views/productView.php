<?php
require_once __DIR__ . '/../includes/classes/ProductsDB.php';

/*
INSERT INTO `cv06_products` (`id`, `name`, `price`, `image`) VALUES
(NULL, 'Škoda Fabia', '150000', 'imgs/fabia.jpg'),
(NULL, 'Audi A6', '400000', 'imgs/A6.jpg'),
(NULL, 'BMW E39', '90000', 'imgs/E39.jpg'),
(NULL, 'Škoda Octavia RS', '120000', 'imgs/O1RS.jpg'),
(NULL, 'Audi RS6', '2500000', 'imgs/RS6.jpg'),
(NULL, 'VW Golf', '120000', 'imgs/Golf5.jpg'),
(NULL, 'VW Transporter', '230000', 'imgs/T5.jpg')
*/

$productsDB = new ProductsDB();

$currentPage = 1;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
}

$productCount = $productsDB->fetchProductCount();
$products = $productsDB->fetchBy(array('where' => array(), 'skip' => ($currentPage - 1) * PRODUCTS_PER_PAGE));

if ($productCount === false) {
    $productCount = 0;
}

if ($products === false) {
    $products = array();
}

$pageCount = ceil(($productCount / PRODUCTS_PER_PAGE));

$pages = array();

if ($currentPage != 1) {
    array_push($pages, array('number' => ($currentPage - 1), 'active' => false, 'link' => BASE_URL . "?page=" . ($currentPage - 1)));
}

array_push($pages, array('number' => $currentPage, 'active' => true, 'link' => BASE_URL . "?page=" . $currentPage));

if ($currentPage != $pageCount) {
    array_push($pages, array('number' => ($currentPage + 1), 'active' => false, 'link' => BASE_URL . "?page=" . ($currentPage + 1)));
}

?>
<div class="row">
    <?php foreach ($products as $product) : ?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <a href="#"><img class="card-img-top" src="<?php echo BASE_URL . $product['image']; ?>" alt="<?php echo $product['name']; ?>"></a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="#"><?php echo $product['name']; ?></a>
                </h4>
                <h5><?php echo number_format($product['price'], 0, ".", " ") . " " . CURRENCY; ?></h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
            </div>
            <?php if (isset($_COOKIE['user'])) : ?>
                <form class="d-inline" method="post">
                    <input type="hidden" name="action" value="addToCart">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="btn btn-primary w-100">Přidat do košíku</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item<?php if ($currentPage == 1) : ?> disabled<?php endif; ?>">
            <a class="page-link" href="<?php echo BASE_URL . "?page=" . ($currentPage - 1);?>"<?php if ($currentPage == 1) : ?> aria-disabled="true"<?php endif; ?>>Předchozí</a>
        </li>
        <?php foreach ($pages as $page) : ?>
            <li class="page-item<?php if ($page['active']) : ?> active<?php endif; ?>"><a class="page-link" href="<?php echo $page['link'];?>"><?php echo $page['number'];?></a></li>
        <?php endforeach; ?>
        <li class="page-item<?php if ($currentPage == $pageCount) : ?> disabled<?php endif; ?>">
            <a class="page-link" href="<?php echo BASE_URL . "?page=" . ($currentPage + 1);?>"<?php if ($currentPage == $pageCount) : ?> aria-disabled="true"<?php endif; ?>>Další</a>
        </li>
    </ul>
</nav>
