<?php

session_start();
require __DIR__ . '/db.php';

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['password_confirm'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter valid email address';
    }

    if ($password != $confirmPassword) {
        $errors['password'] = 'Your passwords do not match.';
        $errors['confirmPassword'] = 'Your passwords do not match.';
    }
    else if (strlen($password) < 5) {
        $errors['password'] = 'Your password must be at least 5 characters long.';
    }

    if (empty($errors)) {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $register = $pdo->prepare("
            INSERT INTO users (email, password)
            VALUES (:email, :password);
            ");
        $register->execute([
            "email" => $email,
            "password" => $hashPassword
        ]);

        $login = $pdo->prepare("
            SELECT * FROM users WHERE email = :email"
         );
            $login->execute([
            'email' => $email
        ]);
        $user = $login->fetchAll()[0];

        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_privilege'] = $user['privilege'];
            header('Location: index.php');        }
    }}

?>

<?php require __DIR__ . '/includes/header.php'; ?>

<main class="container">
<br></br> <br></br>
<h2>Registration</h2>
  <form action="register.php" method="POST">
  <fieldset>
    <div class="control-group">
      <label class="control-label"  for="username">Email</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
      </div>
    </div>
 
    <div class="control-group">
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
        <p class="help-block">Password should be at least 5 characters</p>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="controls">
        <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
        <p class="help-block">Please confirm password</p>
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
