<?php

  require "./ProductsDB.php";

  $products_db = new ProductsDB();

  /* $products = [
    ['name' => 'Tommy Atkins', 'price' => 49.9, 'img' => 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'],
    ['name' => 'Ataulfo', 'price' => 60.9, 'img' => 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'],
    ['name' => 'Kent', 'price' => 47.9, 'img' => 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'],
    ['name' => 'Haden', 'price' => 51.9, 'img' => 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg'],
    ['name' => 'Keitt', 'price' => 39.9, 'img' => 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg'],
    ['name' => 'Francine', 'price' => 59.9, 'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu'],
  ];

  foreach($products as $product) {
    $products_db->create($product);
  } */

  $products = $products_db->fetchAll();

  foreach($products as $product):
?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="<?= $product['img'] ?>" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#"><?= $product['name'] ?></a>
          </h4>
          <h5><?= $product['price'] ?></h5>
        </div>
      </div>
    </div>
  <?php endforeach; ?>