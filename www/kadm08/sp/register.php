<?php

session_start();
require_once __DIR__ . '/lib/UserDB.php';

$errorMessages = [];
$userDB = new UserDB();

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

      $register = $userDB->createUser($email, $hashPassword);

    } catch (PDOException $e) {
      if ($e->errorInfo[1] == 1062) {
        array_push($errorMessages,   'This email is already registered. Try logging in.');
      }
    }
    if (empty($errorMessages)) {
      $user = $userDB->fetchUserByEmail($email);

      if (password_verify($password, $user['password'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['type'] = $user['type'];

        $create_client = $userDB->createClient($user['user_id'], null, null, null);
        $client = $userDB->fetchUser($user['user_id']);
        $_SESSION['client_id'] = $client['client_id'];

        header('Location: myAccount.php');
      }
    }
  }
}

?>

<?php require __DIR__ . '/includes/header.php'; ?>
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