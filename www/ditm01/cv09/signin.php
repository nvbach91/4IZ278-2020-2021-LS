<?php require 'database_connection.php'?>
<?php 
session_start();
$invalidInputs = [];

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Please enter valid email');
    }

    if (!$password || strlen($password) < 5) {
        array_push($invalidInputs, 'Please enter the password');
    }

    if (empty($invalidInputs)) {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $statement = $pdo->prepare($sql); 
        $statement->execute([
            'email' => $email
        ]);
        $existing_user = @$statement->fetchAll()[0];
        if (@password_verify($password, $existing_user['password'])) {
            $_SESSION['user_id'] = $existing_user['id'];
            $_SESSION['user_email'] = $existing_user['email'];
            header('Location: index.php');
        } else {
           array_push($invalidInputs,"Wrong sign in credentials");
        }
    }
}
?>

<?php require __DIR__ . '/includes/header.php' ?>
<main class="container">
    <h2 class="text-center signup">Sign in</h2>
    <ul >
        <?php foreach($invalidInputs as $msg):?>
            <div><strong class="error"><?php echo  $msg."<br>";?></strong></div>
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
<?php require __DIR__ . '/includes/footer.php' ?>