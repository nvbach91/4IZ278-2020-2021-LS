<?php
  require("./partials/header.php");

  if (isset($_POST) && !empty($_POST)) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = $connect->prepare('SELECT * FROM users WHERE email = :email');
    $login->execute([
        'email' => $email
    ]);
    @$user = $login->fetchAll()[0];

    if(password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      $_SESSION['user_privilege'] = (int) $user['privilege'];

      header('Location: home.php');
    } else {
      echo "<div style='padding: 10px; background: firebrick; color: white; border-radius: 10px;' class='alert success'>You are not signed up</div>";
    }
  }
?>

  <h2>Login</h2>
  <form action="index.php" method="POST">
  <form>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Enter your email.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input name="password" type="text" class="form-control" id="password" aria-describedby="passwordHelp">
    <div id="passwordHelp" class="form-text">Enter your email.</div>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
  <a style="margin-left: 10px;" href="signup.php">Sign up</a>
</form>
  </form>

<?php require("./partials/footer.php"); ?>