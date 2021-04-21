<?php
  require("./user-required.php");
  require("./includes/header.php");

  $user = $connect->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
  $user->execute(["user_id" => @$_SESSION['user_id']]);
  $user = $user->fetchAll()[0];

?>

  <h1>Profile</h1>

  <div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= @$_SESSION['user_email'] ?></h5>
        <p class="card-text">Email: <?= $user['email']?></p>
      </div>
    </div>
  </div>
</div>

<?php
  require("./includes/footer.php");
?> 