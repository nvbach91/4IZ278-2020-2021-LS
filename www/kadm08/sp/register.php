<?php

session_start();
require __DIR__ . '/db.php';

$errorMessages = [];

if (!empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['password_confirm'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errorMessages,  'Please enter valid email address');
  }

  if ($password != $confirmPassword) {
    array_push($errorMessages,   'Your passwords do not match.');
  } else if (strlen($password) < 5) {
    array_push($errorMessages,  'Your password must be at least 5 characters long.');
  }

  if (empty($errorMessages)) {
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $register = $pdo->prepare("
            INSERT INTO user (email, password)
            VALUES ( :email, :password);
            ");
    $register->execute([
      "email" => $email,
      "password" => $hashPassword
    ]);

    
    $login = $pdo->prepare(
      "
            SELECT * FROM user WHERE email = :email"
    );
    $login->execute([
      'email' => $email
    ]);
    $user = $login->fetchAll()[0];

    if (password_verify($password, $user['password'])) {
      $_SESSION['email'] = $user['email'];
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['type'] = $user['type'];

      $create_client = $pdo->prepare("
      INSERT INTO client (registration_date, user_id)
      VALUES ( :registration_date, :user_id);
      ");
      $create_client->execute([
        "registration_date" => $_SERVER['REQUEST_TIME'] ,
        "user_id" => $user['user_id']
      ]);

      header('Location: myAccount.php?user_id=' . $_SESSION['user_id']);
    }


  }
}

?>

<?php require __DIR__ . '/includes/header.php'; ?>

<main class="container">
  <br></br> <br></br>
  <h2>Registration</h2>
  <?php foreach ($errorMessages as $message) : ?>
    <p style="color:red;"><?php echo $message; ?></p>
  <?php endforeach; ?>
  <form action="register.php" method="POST">
    <fieldset>
      <div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
          <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
          <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
          <p class="form-text text-muted">Password should be at least 5 characters</p>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="password_confirm">Password (confirm)</label>
        <div class="controls">
          <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
          <p class="form-text text-muted">Please confirm password</p>
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <button class="btn btn-light px-5  shadow-sm">Register</button>
        </div>
      </div>
    </fieldset>
  </form>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>