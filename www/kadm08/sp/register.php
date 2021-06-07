<?php

session_start();
require __DIR__ . '/db.php';

$errorMessages = [];

if (!empty($_POST)) {
  $email =  htmlspecialchars($_POST['email']);
  $password =  htmlspecialchars($_POST['password']);
  $confirmPassword =  htmlspecialchars($_POST['password_confirm']);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errorMessages,  'Please enter valid email address');
  }

  if ($password != $confirmPassword) {
    array_push($errorMessages,   'Your passwords do not match.');
  } else if (strlen($password) < 5) {
    array_push($errorMessages,  'Your password must be at least 5 characters long.');
  }

  if (empty($errorMessages)) {
    try {
      $hashPassword = password_hash($password, PASSWORD_DEFAULT);

      $register = $pdo->prepare("
            INSERT INTO user (email, password)
            VALUES ( :email, :password);
            ");
      $register->execute([
        "email" => $email,
        "password" => $hashPassword
      ]);
    } catch (PDOException $e) {
      if ($e->errorInfo[1] == 1062) {
        array_push($errorMessages,   'This email is already registered. Try logging in.');
      }
    }
    if (empty($errorMessages)) {
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
          "registration_date" => $_SERVER['REQUEST_TIME'],
          "user_id" => $user['user_id']
        ]);

        $get_client = $pdo->prepare(
          "
              SELECT * FROM client WHERE user_id = :user_id"
        );
        $get_client->execute([
          'user_id' => $user['user_id']
        ]);
        $client = $get_client->fetchAll()[0];
        $_SESSION['client_id'] = $client['client_id'];

        header('Location: myAccount.php');
      }
    }
  }
}

?>

<?php require __DIR__ . '/includes/header.php'; ?>
<br></br>
<main class="container">
<div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign up</h5>
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