<?php

session_start();
require __DIR__ . '/includes/header.php'; 

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = @$_POST['email'];
    $password = @$_POST['password'];

    $stmt = $connect->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([
        'email' => $email
    ]);
    $existing_user = @$stmt->fetchAll()[0];

    if (empty($existing_user)) {
        $errors['email'] = 'User with this email address was not found!';
    }
    else if (@password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['user_id'];
        $_SESSION['user_email'] = $existing_user['email'];
        $_SESSION['admin'] = $existing_user['role'] == 2 ? true : false;

        header('Location: index.php');
    }
    else {
        $errors['password'] = 'You entered wrong password! Try again.';
    }
}
  // require("./includes/header.php");

  // session_start();
  // if ('POST' == $_SERVER['REQUEST_METHOD']) {

  //   $email = $_POST['email'];
  //   $password = $_POST['password'];

  //   // $email = htmlspecialchars($_POST['email']);
  //   // $password = htmlspecialchars($_POST['password']);
  //   $exists = $connect->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
  //   // $exists->execute(array('email' => $email, 'pass' => $password));
  //   // $exists = $exists->fetchColumn();

  //   $exists->execute([
  //     'email' => $email
  // ]);

  // $existing_user = @$exists->fetchAll()[0];

  // var_dump($existing_user);
  //   if (password_verify($password, $existing_user['password'])) {
  //       $_SESSION['user_id'] = $existing_user['id'];
  //       $_SESSION['user_email'] = $existing_user['email'];

  //       header('Location: index.php');
  //   } else {
  //     echo "<div style='padding: 10px; background: firebrick; color: white; border-radius: 10px;' class='alert success'>Invalid Email or Password</div>";
  //   }

  //   // if ($email === $exists) {
  //   //   $minutesOfLogin = 60; //in minutes
  //   //   setcookie('email', $email, time() + $minutesOfLogin*60);

  //   //   header('Location: index.php');
  //   // } else {
  //   //   echo "<div style='padding: 10px; background: firebrick; color: white; border-radius: 10px;' class='alert success'>You are not signed up</div>";
  //   // }
  // }
?>

<h1>Login</h1>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger text-center">
            <p class="mb-1"><?php echo 'There are some errors in your login form!'; ?></p>
            <a href="index.php"><i class="fas fa-arrow-left mr-2"></i>Go Back</a>
        </div>
    <?php endif; ?>
    <form class="login-form" method="POST">
        <div class="form-group">
            <label for="password">Email</label>
            <input class="form-control<?php echo isset($errors['email']) ? ' is-invalid' : ''; ?>" value="<?php echo @$_POST['email']; ?>" placeholder="Enter your email address" name="email" id="email">
            <?php if(isset($errors['email'])): ?>
                <small class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $errors['email']?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control <?php echo isset($errors['password']) ? ' is-invalid' : ''; ?>" placeholder="Enter password" name="password" id="password" type="password">
            <?php if(isset($errors['password'])): ?>
                <small class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $errors['password']?>
                </small>
            <?php endif; ?>
        </div>
            <button class="btn btn-primary mt-3" type="submit">Log In</button>
    </form>
    <a href="registration.php">Don't have an account yet? Go to sign up!</a>
<div style="margin-bottom: 600px"></div>


<?php require("./includes/footer.php"); ?> 