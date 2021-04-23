<?php
  include "partials/header.php";


  if (!isset($_SESSION['user_id'])) {
      header('Location: index.php');
      die();
  }

  if($_SESSION['user_id'])
  if (!empty($_GET)) {
    $offset = $_GET['offset'];
  } else {
    $offset = 0;
  }

  $numberOfItemsPerPagination = 5;
  $numberOfGoods = $connect->query("SELECT COUNT(id) FROM goods;")->fetchColumn();


  $sql = "SELECT * FROM goods WHERE 1 LIMIT $numberOfItemsPerPagination OFFSET ?;";
  $statement = $connect->prepare($sql);
  $statement->bindValue(1, $offset, PDO::PARAM_INT);
  $statement->execute();

  $goods = $statement->fetchAll(PDO::FETCH_ASSOC);


  $numberOfPaginations = ceil($numberOfGoods / $numberOfItemsPerPagination);
?>

    <h1>Number of goods: <?= $numberOfGoods; ?></h1>
    <h2>Number of pagination: <?= $numberOfPaginations; ?></h2>
    <?php if($_SESSION['user_privilege'] > 1): ?>
      <h3><a href="./create-item.php">Create good</a></h3>
    <?php endif; ?>
    <div class="paginations">
      <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
        <a class="pagination<?= $offset / $numberOfItemsPerPagination + 1 == $i ? ' active' : ''; ?>" href="home.php?offset=<?= $numberOfItemsPerPagination * ($i - 1); ?>">
          <?= $i; ?>
        </a>
      <?php } ?>
    </div>

    <div class="goods">
      <?php foreach ($goods as $good) : ?>
        <div class="good card" style="width: 18rem;">
          <img class="card-img-top" src="<?= isset($good['img']) ? $good['img'] : './img/img.jpg' ?>" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?= $good['name']; ?></h5>
            <h6 class="card-title"><?= $good['price']; ?></h6>
            <p class="card-text"><?= $good['description']; ?></p>
          <?php if($_SESSION['user_privilege'] > 1): ?>
            <a href="edit-item.php?id=<?= $good["id"]; ?>" class="btn btn-primary">Update</a>
            <a href="delete-item.php?id=<?= $good["id"]; ?>" class="btn btn-primary">Delete</a>
          <?php endif; ?>
            <a href="buy.php?id=<?= $good['id']; ?>" class="btn btn-primary">Buy</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="paginations">
      <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
        <a class="pagination<?= $offset / $numberOfItemsPerPagination + 1 == $i ? ' active' : ''; ?>" href="home.php?offset=<?= $numberOfItemsPerPagination * ($i - 1); ?>">
          <?= $i; ?>
        </a>
      <?php } ?>
    </div>
  
  </main>

<?php include "partials/footer.php"; ?>