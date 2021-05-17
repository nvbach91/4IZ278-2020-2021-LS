<?php require "./db/modulsDB/ProductsDB.php"; 

$productsDB = new ProductsDB();
$products = $productsDB->fetchAll();

?>
<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <img class="card-img-top product-image" src="<?php echo $product['image']; ?>" alt="img">
      <div class="card-body">
        <h4 class="card-title"><?php echo $product['product_name']; ?></h4>
        <h5><?php echo $product['price']; ?></h5>
        <p class="card-text"><?php echo 'Lorem ipsum dolor amet sungo motte balu kareso loqes'; ?></p>
      </div>
      <div class="text-end">
        <button type="button" class="btn">Buy</button>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>