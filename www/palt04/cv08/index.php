<?php require __DIR__ . '/includes/header.php';
  

  if (!empty($_GET)) {
    $offset = $_GET['offset'];
  } else {
    $offset = 0;
  }

  $numberOfItemsPerPagination = 5;
  //$numberOfGoods = $connect->query("SELECT COUNT(id) FROM goods;")->fetchColumn();

  $sql = "SELECT COUNT(id) FROM goods";
  $res = $connect->query($sql);
  $numberOfGoods = $res->fetchColumn();

  $sql = "SELECT * FROM goods WHERE 1 LIMIT $numberOfItemsPerPagination OFFSET ?;";
  $statement = $connect->prepare($sql);
  $statement->bindValue(1, $offset, PDO::PARAM_INT);
  $statement->execute();

  $goods = $statement->fetchAll(PDO::FETCH_ASSOC);


  $numberOfPaginations = ceil($numberOfGoods / $numberOfItemsPerPagination);

?>

    <h1>Total mango count: <?= $numberOfGoods; ?></h1>
    <h2>Number of pagination: <?= $numberOfPaginations; ?></h2>
    <h3><a href="./create-good.php" class="btn btn-outline-danger">Create good</a></h3>
    <ul class="pagination">
      <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
        <li class="page-item <?= $offset / $numberOfItemsPerPagination + 1 == $i ? ' active' : ''; ?>">
        <a class="page-link" href="index.php?offset=<?= $numberOfItemsPerPagination * ($i - 1); ?>">
          <?= $i; ?>
        </a>
        </li>
      <?php } ?>
      </ul>

    <div class="row">
        <?php foreach ($goods as $good) : ?>
            <div class="col-lg-4 col-md-6 mb-4">           
                    <div class="card h-100" style="width: 18rem;">
                        <img class="card-img-top" src="<?= isset($good['img']) ? $good['img'] : './img/img.jpg' ?>" alt="Card image cap">
                        <div class="card-body">
                                <h5 class="card-title"><?= $good['name']; ?></h5>
                                <h6 class="card-title"><?= $good['price']; ?></h6>
                                <p class="card-text"><?= $good['description']; ?></p>

                               
                        </div>
                        <div class="card-footer">
                            <a href="edit-good.php?id=<?= $good["id"]; ?>" class="btn btn-primary">Update</a>
                            <a href="remove-good.php?id=<?= $good["id"]; ?>" class="btn btn-primary">Delete</a>
                             <a href="buy.php?id=<?= $good['id']; ?>" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
            </div>
        <?php endforeach; ?>
    <ul class="pagination">
      <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
        <li class="page-item <?= $offset / $numberOfItemsPerPagination + 1 == $i ? ' active' : ''; ?>">
        <a class="page-link" href="index.php?offset=<?= $numberOfItemsPerPagination * ($i - 1); ?>">
          <?= $i; ?>
        </a>
        </li>
      <?php } ?>
      </ul>

    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>