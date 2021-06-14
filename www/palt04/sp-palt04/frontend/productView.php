<?php

  if (!empty($_GET['offset'])) {
    $offset = $_GET['offset'];
  } else {
    $offset = 0;
  }


  // $productsDB = new ProductsDB();

  // $numberOfGoods = $productsDB->fetchAll();

  $numberOfItemsPerPagination = 6;
  //$numberOfGoods = $connect->query("SELECT COUNT(id) FROM goods;")->fetchColumn();



  if (isset($_GET['categoryid'])) {
    $sql = "SELECT COUNT(id) FROM goods WHERE category=?";
    $statement = $connect->prepare($sql);
    $statement->bindValue(1, $_GET['categoryid'], PDO::PARAM_INT);
    $statement->execute();
    $numberOfGoods = $statement->fetchColumn();

    $sql = "
    SELECT * FROM goods
    WHERE category=?
    LIMIT ?
    OFFSET ?;";
    $statement = $connect->prepare($sql);
    $statement->bindValue(1, $_GET['categoryid'], PDO::PARAM_INT);
    $statement->bindValue(2, $numberOfItemsPerPagination, PDO::PARAM_INT);
    $statement->bindValue(3, $offset, PDO::PARAM_INT);
    $statement->execute();
  } else {
    $sql = "SELECT COUNT(id) FROM goods";
    $res = $connect->query($sql);
    $numberOfGoods = $res->fetchColumn();

    $sql = '
    SELECT * FROM goods
    LIMIT ?
    OFFSET ?;';
    $statement = $connect->prepare($sql);
    $statement->bindValue(1, $numberOfItemsPerPagination, PDO::PARAM_INT);
    $statement->bindValue(2, $offset, PDO::PARAM_INT);
    $statement->execute();
  }


  $goods = $statement->fetchAll(PDO::FETCH_ASSOC);

  $numberOfPaginations = ceil($numberOfGoods / $numberOfItemsPerPagination);

?>
<div class="row">

<?php foreach ($goods as $good) : ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
      <a href="#"><img class="card-img-top" src="<?= isset($good['img']) ? $good['img'] : './img/img.jpg' ?>" alt="Card image cap"></a>
      <div class="card-body">
        <h4 class="card-title">
          <?= $good['name']; ?>
        </h4>
        <h5><?= $good['price']; echo $currency?></h5>
        <p class="card-text"><?= $good['description']; ?></p>
      </div>
      <div class="card-footer">
        <?php if(isset($_SESSION['admin']) && $_SESSION['admin']): ?>
          <a href="update-product.php?id=<?= $good['id'] ?>" class="btn btn-primary">Update</a>
          <a href="delete-product.php?id=<?= $good["id"] ?>" class="btn btn-danger">Delete</a>
        <?php  elseif(isset($_SESSION['admin']) && !$_SESSION['admin']): ?>
          <a href="buy.php?id=<?= $good['id']; ?>" class="btn btn-primary">Buy</a>
        <?php else:?>
          Please login to buy product.
        <?php endif; ?>
      </div>
    </div>
  </div>   
<?php endforeach; ?>
</div>
<ul class="pagination mx-auto ">
      <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
        <li class="page-item <?= $offset / $numberOfItemsPerPagination + 1 == $i ? ' active' : ''; ?>">
        <a class="page-link" href="index.php?offset=<?= $numberOfItemsPerPagination * ($i - 1); ?>">
          <?= $i; ?>
        </a>
        </li>
      <?php } ?>
</ul>