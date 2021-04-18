<?php
  require("./partials/header.php");
  
  if (@!$_SESSION['user_privilege']) {
    header('Location: logout.php');
    die();
  }

  $user = $connect->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
  $user->execute(["email" => @$_SESSION['user_email']]);
  $user = $user->fetchAll()[0];

?>

  <h1>Profile</h1>

  <div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= @$_SESSION['user_email'] ?></h5>
      </div>
    </div>
  </div>
</div>

<?php
  require("./partials/footer.php");
?>