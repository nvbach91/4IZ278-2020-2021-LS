<?php
  require("./partials/header.php");

  if (!empty($_POST)) {

    $username = htmlspecialchars($_POST['username']);
    $exists = $connect->prepare("SELECT username FROM users WHERE username = :username;");
    $exists->execute(["username" => $username]);
    $exists = $exists->fetchColumn();

    if ($username === $exists) {
      $minutesOfLogin = 60; //in minutes
      setcookie('username', $username, time() + $minutesOfLogin*60);
      
      header('Location: index.php');
    } else {
      echo "<div style='padding: 10px; background: firebrick; color: white; border-radius: 10px;' class='alert success'>You are not signed up</div>";
    }
  }
?>

  <h2>Login</h2>
  <form action="login.php" method="POST">
  <form>
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Enter your username.</div>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
  </form>

<?php require("./partials/footer.php"); ?>