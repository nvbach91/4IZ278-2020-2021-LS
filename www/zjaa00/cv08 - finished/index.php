<?php
  require 'user_required.php';
  if (isset($_GET['offset'])) {
    $offset = (int) $_GET['offset'];
  } else {
    $offset = 0;
  }
  // celkovy pocet zbozi pro strankovani
  $count = $connect->query('SELECT COUNT(id) FROM goods')->fetchColumn();
  $stmt = $connect->prepare('SELECT * FROM goods ORDER BY id DESC LIMIT 5 OFFSET ?');
  $stmt->bindValue(1, $offset, PDO::PARAM_INT);
  $stmt->execute();
  $goods = $stmt->fetchAll();
  

  include "partials/header.php";
?>

<main class="container">
    <h1>Goods we've got</h1>
    <h2>Total goods: <?php echo $count; ?></h2>
    <br>
    <br>
    <a href="new.php">New good</a>
    <br>
    <br>
    <div class="pagination">
        <?php for ($i = 1; $i <= ceil($count / 10); ++$i): ?>
        <a class="<?php echo $offset / 10 + 1 == $i ? 'active' : ''; ?>" href="index.php?offset=<?php echo ($i - 1) * 10; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
    <br>
    <div class="goods">
      <?php foreach ($goods as $good): ?>
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="./img/logo.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $good["name"]; ?></h5>
              <h5 class="card-title"><?php echo $good["price"]; ?> Kč</h5>
              <p class="card-text"><?php echo $good["description"]; ?></p>
              <a href="update.php?id=<?php echo $good["id"]; ?>" class="btn btn-primary">Update</a>
              <a href="delete.php?id=<?php echo $good["id"]; ?>" class="btn btn-primary">Delete</a>
              <a href="buy.php?id=<?php echo $good["id"]; ?>" class="btn btn-primary">Buy</a>
            </div>
          </div>
          <?php endforeach; ?>
    </div>
</main>
<div style="margin-bottom: 600px"></div>
  
  <?php include "partials/footer.php"; ?>