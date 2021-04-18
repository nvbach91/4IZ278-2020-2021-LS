<?php
    session_start();
    require __DIR__ . '/includes/header.php'; 
    require __DIR__ . '/db.php';

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = @$_POST['email'];
        $password = @$_POST['password'];
        
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([
            'email' => $email
        ]);
        $existing_user = @$stmt->fetchAll()[0];

        if (empty($existing_user)) {
            $errors['email'] = 'User with this email address was not found!';
        }
        else if (@password_verify($password, $existing_user['password'])) {
            $_SESSION['user_id'] = $existing_user['id'];
            $_SESSION['user_email'] = $existing_user['email'];
            $_SESSION['admin'] = $existing_user['role'] == 2 ? true : false;

            header('Location: index.php');
        }
        else {
            $errors['password'] = 'You entered wrong password! Try again.';
        }
    }

?>

<main class="container">
    <h1 class="text-center">Login</h1>
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
        <div class="row justify-content-center">
            <button class="btn btn-dark" type="submit">Log In</button>
        </div>
    </form>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>