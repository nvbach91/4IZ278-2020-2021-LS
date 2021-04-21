<?php
  require("./partials/header.php");

  if (!empty($_POST)) {

    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $signup = $connect->prepare("
      INSERT INTO users (email, password)
      VALUES (:email, :password);
    ");
    $signup->execute([
      "email" => $email,
      "password" => $password
    ]);

    $login = $connect->prepare('SELECT * FROM users WHERE email = :email');
    $login->execute([
        'email' => $email
    ]);
    $user = $login->fetchAll()[0];

    
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_privilege'] = (int) $user['privilege'];
  
    header('Location: home.php');

  }
?>

  <h2>Signup</h2>
  <form action="signup.php" method="POST">
  <form>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Enter your email.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input name="password" type="text" class="form-control" id="password" aria-describedby="passwordHelp">
    <div id="passwordHelp" class="form-text">Enter your password.</div>
  </div>
  <button type="submit" class="btn btn-primary">Signup</button>
  <a href="signup.php"></a>
</form>
  </form>

<?php require("./partials/footer.php"); ?>