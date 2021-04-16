<?php
  require("./includes/header.php");

  $user = $connect->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
  $user->execute(["username" => @$_COOKIE['username']]);
  $user = $user->fetchAll()[0];

?>

  <h1>Profile</h1>

  <div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img width="100%" height="auto" src="./img/<?= $user['img'] ?>" alt="You">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= @$_COOKIE['username'] ?></h5>
        <p class="card-text">Email: <?= $user['email']?></p>
      </div>
    </div>
  </div>
</div>

<?php
  require("./includes/footer.php");
?> 