<?php
session_start();
require 'db.php';
$invalidInputs = [];
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    // zajimavost: mysql porovnani retezcu je case insensitive, pokud dame select na NECO@DOMENA.COM, najde to i zaznam neco@domena.com
    // viz http://dev.mysql.com/doc/refman/5.0/en/case-sensitivity.html

    $stmt = $db -> prepare('SELECT * FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'email' => $email
    ]);
    echo "<script>console.log('$email');</script>";
    $existing_user = @$stmt->fetchAll()[0];
    var_dump($existing_user);
    if (@password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['id'];
        $_SESSION['user_email'] = $existing_user['email'];


        header('Location: index.php');
    } else {
        echo "<script>console.log('$password');</script>";
       array_push($invalidInputs,"Wrong sign in credentials");
    }
}
?>


<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <h2>Sign in</h2>
    <ul class="ul_error">
        <?php foreach($invalidInputs as $msg):?>
            <div class="error"><?php echo  $msg;?></div>
        <?php endforeach; ?>
    </ul>
    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        </div>

        <div class="form-label-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
    </form>
    <a href="signup.php">Don't have an account yet? Go to sign up!</a>
</main>

<div style="margin-bottom: 600px"></div>

<?php require __DIR__ . '/incl/footer.php' ?> 