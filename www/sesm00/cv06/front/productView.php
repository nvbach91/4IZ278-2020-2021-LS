<?php
require __DIR__ . '/../includes/classes/ProductsDB.php';

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

$products = $productsDB->fetchAll();


?>
<?php foreach ($products as $product) : ?>
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top" src="<?php echo BASE_URL . $product['image']; ?>" alt=""></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="#"><?php echo $product['name']; ?></a>
            </h4>
            <h5><?php echo number_format($product['price'], 0, ".", " ") . " " . CURRENCY; ?></h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
        </div>
        <div class="card-footer d-none">

        </div>
    </div>
</div>
<?php endforeach; ?>
