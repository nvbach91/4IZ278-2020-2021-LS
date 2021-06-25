<?php require __DIR__ . '/../database/ProductsDB.php'; ?>
<?php

  $productsDB = new ProductsDB();
  //$products = $productsDB->fetchAll();

  $nItemsPerPagination = 4;

  if (isset($_GET['offset'])) {
      $offset = (int)$_GET['offset'];
  } else {
      $offset = 0;
  }

  $count = $productsDB->countPages();
  $products = $productsDB->fetchAllPaging($offset, $nItemsPerPagination);
?>

  <ul class="catalog-list">
    <?php foreach($products as $product): ?>
    <li class="catalog-item">
      <article class="catalog-item-block">
        <a class="catalog-item-link" href="#">
          <img src="<?php echo $product['product_img']; ?>" width="360" height="380" alt="device product image">
        </a>
        <div class="catalog-description-wrapper">
          <h1 class="catalog-item-description"><a href="#"><?php echo $product['product_name']; ?></a></h1>
          <span class="catalog-item-price"><?php echo number_format($product['product_price'], 2), ' ', GLOBAL_CURRENCY; ?></span>
        </div>
        <div class="catalog-item-hover">
          <a class="button catalog-button" href="#">Add to cart</a>
          <a class="catalog-compare-link" href="#">Add to compare</a>
        </div>
      </article>
    </li>
    <?php endforeach; ?>
  </ul>
</section>

<section class="pages">
  <h2 class="visually-hidden">Pages</h2>
  <ul class="pages-list">
    <li class="pages-item">
      <!-- <a class="pages-item-link">Back</a> -->
    </li>
    <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
      <li class="pages-item">
        <a class="<?php echo $offset / $nItemsPerPagination + 1 == $i ? "pages-item-link current-page" : "pages-item-link"; ?>" href="./catalog.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
            <?php echo $i; ?>
        </a>
      </li>
    <?php } ?>
    <li class="pages-item">
      <!-- <a class="pages-item-link" href="#">Next</a> -->
    </li>
  </ul>
</section>