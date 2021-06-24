<?php 

    require("./config/config.php");
    if (!isset($_SESSION['user_email'])) {
        header('Location: login.php');
    }
    
    $stmt = $connect->prepare('SELECT product_id FROM products_orders WHERE order_id = :order_id');
    $stmt->execute([
          'order_id' => $_GET['id']
    ]);

    $products_ids = $stmt->fetchAll();
    $products_ids = array_values($products_ids);
    $only_ids = array();
    foreach($products_ids as $product_id){
      array_push($only_ids,$product_id['product_id']);
    }
   // var_dump($products_ids)."</br>";

    $statement = $connect->prepare('SELECT * FROM goods WHERE 1');
    $statement->execute();
    $products = $statement->fetchAll();
    //var_dump($products);

    $totalAmount = 0;

    require("./partials/header.php");
    require("./navigation.php");


?>


<div class="container">
    <div class="card">
    <table class="table table-hover shopping-cart-wrap">
    <thead class="text-muted">
    <tr>
      <th scope="col">Product</th>
      <th scope="col" width="120">Price</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
        <?php if(in_array($product['id'],$only_ids)):
        $totalAmount+= $product['price'];?>
        <tr>
          <td>
        <figure class="media">
          <div class="img-wrap"><img src="<?= isset($product['img']) ? $product['img'] : './img/img.jpg' ?>" width="150px"></div>
          <figcaption class="media-body">
            <h6 class="title text-truncate"><?= $product['name']; ?></h6>
            <dl class="param param-inline small">
              <dt>Description: </dt>
              <dd><?= $product['description']; ?></dd>
            </dl>
          </figcaption>
        </figure> 
          </td>
          <td> 
            <div class="price-wrap"> 
              <var class="price"><?= $product['price']; echo $currency; ?></var> 
            </div>
          </td>
        </tr>
        <?php endif; ?>
    <?php endforeach;?>
</tbody>
</table>
</div>
<div class="p-3 mb-2 bg-info text-white">Total price: <?php echo $totalAmount; echo $currency?></div>
<?php require("./partials/footer.php"); ?>

