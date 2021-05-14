<?php require __DIR__ . '/config.php'; ?>
<?php
session_start();


$invalidInputs = [];
$msg = '';
$msgClass = '';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $pdo -> prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $statement->execute([
        'email' => $email
    ]);
    $existing_user = @$statement->fetchAll()[0];

    if (@password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['id'];
        $_SESSION['user_email'] = $existing_user['email'];
        $_SESSION['user_privillage'] = $existing_user['privillage'];
 

        header('Location: index.php');
    } else {
        $msg = 'Combination of email and password is incorrect';
        $msgClass = 'alert-danger';
    }
}
?>

<?php include __DIR__ . '/includes/header.php' ?>





    <body>
    <div class="container">
    <br>
     

    <h2>Sign in</h2>

    <?php if ($msg != '') : ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>

    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
        </div>

        <div class="form-label-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
        </div>
        <br>
        <button class="button-red text-uppercase" type="submit">Sign in</button>
    </form>
    <a href="signup.php">Don't have an account yet? Go to sign up!</a>
    </div>
    <div style="margin-bottom: 600px"></div>
<?php include __DIR__ . '/includes/footer.php' ?>