<?php require __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
/* INSERT INTO `products` (`name`, `price`, `img`) VALUES
('Ferrari SF90', 300, 'https://www.autoweb.cz/wp-content/uploads/2019/05/ferrari_sf90_stradale_98-1100x618.jpg'),
('Ferrari F8 Spider',400,'https://img.carismo.cz/e/e8/e8d/e8dd082e90999bd8dfdeb406180d775e.jpg'),
('Ferrarri Porofino M',350,'https://d62-a.sdn.cz/d_62/c_img_QN_Q/K0Hn/Ferrari-Portofino-M.jpeg'),
('Ferrari 812',800,'https://img.carismo.cz/1/14/14f/14f4fb37081f90be7e88d20ce306174a.jpg'),
('Ferrari Monza',1000,'https://img.tipcars.com/fotky_velke/20734221_1/1599148358/E/ferrari-monza-sp2-ihned-6-5.jpg'),
('Ferrari 488',5590,'https://img.carismo.cz/4/4f/4ff/4ff07948b83b95512390ba70ca158214.jpg'),
('Ferrari FF',6000, 'https://m.autorevue.cz/Getfile.aspx?id_file=862941635'),*/

$productsDB = new ProductsDB();
$products = $productsDB->fetchAll();

?>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <a href="#"><img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="mango-product-image"></a>
      <div class="card-body">
        <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
        <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
        <p class="card-text"><?php echo 'Lorem ipsum dolor amet sungo motte balu kareso loqes'; ?></p>
      </div>
      <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>