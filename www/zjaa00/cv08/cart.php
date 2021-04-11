<?php
  require("./_inc/config.php");
  session_start();

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  $ids = $_SESSION['cart'];
  $goods = [];

  if (is_array($ids) && count($ids)) {
    $questionMarks = str_repeat("?, ", count($ids) - 1) . '?';
    
    $sql = "SELECT * FROM goods WHERE id IN(". $questionMarks .")";
    $statement = $connect->prepare($sql);
    $statement->execute(array_values($ids));

    $goods = $statement->fetchAll();
  }
  require("./partials/header.php");

?>
 
  <div class="goods">
    <?php 
      if ($goods):
      foreach ($goods as $good) : ?>
      <div class="good card" style="width: 18rem;">
        <img class="card-img-top" src="<?= isset($good['img']) ? $good['img'] : './img/img.jpg' ?>" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><?= $good['name']; ?></h5>
          <h6 class="card-title"><?= $good['price']; ?></h6>
          <p class="card-text"><?= $good['description']; ?></p>
          <a href="remove-item.php?id=<?= $good['id']; ?>" class="btn btn-primary">Remove</a>
        </div>
      </div>
    <?php endforeach; else: ?>
      <div style="padding: 10px; background: #efefef; color: firebrick; border-radius: 10px;"> Cart is empty </div>
    <?php endif; ?>
  </div>

<?php require("./partials/footer.php"); ?>