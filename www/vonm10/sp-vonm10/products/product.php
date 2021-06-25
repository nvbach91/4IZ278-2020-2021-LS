<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
$productId = $_GET['id'];
$productsDB = new ProductsDB();
$product = $productsDB->fetch($productId);
?>



<?php require __DIR__ . '/../incl/header.php'; ?>

<main class="container">
  <img width="500" height="600" style = "display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;" src="<?php echo $product['img']; ?>" alt=<?php echo $product['name'] ?>>
  <div class="card-body" style = "text-align: center;">
    <h4 class="card-title" <?php echo $product['name']; ?>></h4>
    <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
      <div>
        <a href="buy.php?id=<?php echo $product['id'] ?>">Add to cart</a>
      </div>
    <p class="card-text"><?php echo $product['description']; ?></p>
  </div>
</main>

<?php require __DIR__ . '/../incl/footer.php'; ?>