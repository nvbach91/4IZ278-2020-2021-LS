<?php
  require("./config/config.php");

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  if (!isset($_GET['error'])) {

  }

  $ids = $_SESSION['cart'];
  $goods = [];

  $totalAmount = 0;
  if (is_array($ids) && count($ids)) {
    $questionMarks = str_repeat("?, ", count($ids) - 1) . '?';

    $sql = "SELECT * FROM goods WHERE id IN(". $questionMarks .")";
    $statement = $connect->prepare($sql);
    $statement->execute(array_values($ids));

    $goods = $statement->fetchAll();
  }
  require("./partials/header.php");
  require("./navigation.php");

?>

<div class="container">
  <?php if(isset($_GET['error'])): ?>
    <div style="padding: 25px; background: #efefef; color: firebrick; border-radius: 10px;"> One of the product is already sold </div>
  <?php endif ?>
  <?php if ($goods): ?>
    <div class="card">
    <table class="table table-hover shopping-cart-wrap">
    <thead class="text-muted">
    <tr>
      <th scope="col">Product</th>
      <th scope="col" width="120">Price</th>
      <th scope="col" width="200" class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($goods as $good) : $totalAmount+= $good['price']?>
        <tr>
          <td>
        <figure class="media">
          <div class="img-wrap"><img src="<?= isset($good['img']) ? $good['img'] : './img/img.jpg' ?>" width="150px"></div>
          <figcaption class="media-body">
            <h6 class="title text-truncate"><?= $good['name']; ?></h6>
            <dl class="param param-inline small">
              <dt>Description: </dt>
              <dd><?= $good['description']; ?></dd>
            </dl>
          </figcaption>
        </figure> 
          </td>
          <td> 
            <div class="price-wrap"> 
              <?php if($good['in_stock']==0):?>
                <p class="text-danger">Sold out</p>
              <?php else: ?>
                <var class="price"><?= $good['price']; echo $currency; ?></var>
              <?php  endif; ?> 
            </div>
          </td>
          <td class="text-right"> 
          <a href="remove-item-from-cart.php?id=<?= $good['id']; ?>" class="btn btn-outline-danger"> × Remove</a>
          </td>
        </tr>
    <?php endforeach;?>
</tbody>
</table>
</div>
<h5 class="my-2">Total amount: <?= $totalAmount; echo $currency?></h5>
<a class="btn btn-primary" href="checkout.php">Check out</a>
<?php  else: ?>
  <div style="padding: 25px; background: #efefef; color: firebrick; border-radius: 10px;"> Cart is empty </div>
<?php endif; ?>
</div>

<?php require("./partials/footer.php"); ?>