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
        array_push($invalidInputs, 'Please enter valid password');
    }

    if (empty($invalidInputs)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = ('INSERT INTO users(email, password, privileges) VALUES (:email, :password, 1)');
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'email' => $email,
            'password' => $hashedPassword
        ]);
        
        $sql = ('SELECT id FROM users WHERE email = :email ');
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'email' => $email
        ]);
        $user_id = (int) $statement->fetchColumn();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;

        header('Location: index.php');
    }
}
?>

<?php require __DIR__ . '/includes/header.php' ?>
<main class="container">
    <h2 class="text-center signup">New Signup</h2>
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
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Create account</button>
    </form>
</main>
<?php require __DIR__ . '/includes/footer.php' ?>