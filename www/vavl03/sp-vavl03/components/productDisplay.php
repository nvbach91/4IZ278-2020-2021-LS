<?php require __DIR__ . '/../db/ProductsDB.php'; ?>
<?php require __DIR__ . '/../db/ProductCategoryDB.php'; ?>
<?php
require 'global.php';
/* INSERT INTO `product` (`product_name`, `product_description`, `product_price`, `product_img` ) VALUES
('ASUS Radeon TUF-RX6800-O16G-GAMING, 16GB GDDR6', 
'Vysoce výkonná herní grafická karta v podání ASUS, rozhraní PCIe 4.0, frekvence až 2190 MHz,
16 GB GDDR6 paměti, rychlost paměti 16 Gb/s, 256-bit sběrnice, konektory: 1x HDMI 2.1, 3x DisplayPort 1.4a;
napájení 2x 8-pin, max. rozlišení 7680x4320, OpenGL 4.6, DirectX 12 Ultimate, AMD FreeSync, AMD Radeon Anti-Lag, hardwarový Raytracing, 2,9-slot design.',
 1200,'https://iczc.cz/2cvspafm6ujf7ad79dqp1at5rc-1_2/obrazek');
*/
# offset pro strankovani
$nItemsPerPagination = 6;
if (isset($_GET['offset'])) {
  $offset = (int)$_GET['offset'];
} else {
  $offset = 0;
}

# load products from specified category if the category is specified in url
$productsDB = new ProductsDB();
$productsCategoryDB = new ProductCategoryDB();

if (isset($_GET['category'])) {
  $categoryProducts = [];
  $category = $_GET['category'];
  $products = $productsDB->fetchProductsByCategory($category, $nItemsPerPagination, $offset);
  # celkovy pocet zbozi z kategorie pro strankovani 
  $count = count($productsDB->fetchCountedCategoryProducts($category));
} else {
  $products = $productsDB->fetchProdcutsByPagination($nItemsPerPagination, $offset); // loads only 1 product from each name
  # celkovy pocet zbozi pro strankovani
  $count = count($productsDB->fetchCountedProducts());
  $category = null;
}
# pocet jedontilich produktu v db
function getProductPcs($productName)
{
  global $productsDB;
  $countPcs = $productsDB->fetchProductPcs($productName);
  return $countPcs;
}
?>
<script>
  console.log(<?= json_encode($count); ?>);
  console.log(<?= json_encode($products); ?>);
  console.log(<?= json_encode($category); ?>);
 
</script>

<?php if (count($products) > 0) : ?>
<div class="row">
  <?php foreach ($products as $product) : ?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 product">
        <div class="card-img-top" style="background-image: url(<?php echo $product['product_img']; ?>)"></div>
        <div class="card-body">
          <h4 class="card-title"><?php echo htmlspecialchars($product['product_name'],ENT_QUOTES, 'UTF-8'); ?></h4>
          <div class="price-pieces">
            <h5><?php echo htmlspecialchars(number_format($product['product_price'], 2, '.', ''),ENT_QUOTES, 'UTF-8'), ' ', GLOBAL_CURRENCY ?></h5>
            <h5><?php echo htmlspecialchars(getProductPcs($product['product_name'],ENT_QUOTES, 'UTF-8')); ?> pcs left</h5>
          </div>

          <p class="card-text"><?php echo htmlspecialchars($product['product_description'],ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="card-footer">
          <a class="btn btn-primary btn-buy card-link" href='components/buy.php?id=<?php echo htmlspecialchars($product['product_id'],ENT_QUOTES, 'UTF-8'); ?>'>Buy</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php else : ?>
    <div class="col-lg-12 no-products">
      <p>Unfortunately, there are no products :(</p>
    </div>
  <?php endif; ?>
<?php if ($category) : ?>
  <div class="pagination">
    <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
      <a class="<?php echo $offset / $nItemsPerPagination + 1 == $i ? "active" : ""; ?>" href="index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>&category=<?php echo $category; ?>">
        <?php echo htmlspecialchars($i,ENT_QUOTES, 'UTF-8'); ?>
      </a>
    <?php } ?>
  </div>
<?php else : ?>
  <div class="pagination">
    <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
      <a class="<?php echo $offset / $nItemsPerPagination + 1 == $i ? "active" : ""; ?>" href="index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
        <?php echo htmlspecialchars($i,ENT_QUOTES, 'UTF-8'); ?>
      </a>
    <?php } ?>
  </div>
<?php endif; ?>