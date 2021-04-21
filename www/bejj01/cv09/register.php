<?php
    session_start();
    require __DIR__ . '/includes/header.php'; 
    require __DIR__ . '/db.php';

    $errors = [];

    if (!empty($_POST)) {
        $email = @$_POST['email'];
        $password = @$_POST['password'];
        $confirm = @$_POST['confirm'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter valid email address';
        }

        if ($password != $confirm) {
            $errors['password'] = 'Your passwords does not match each other!';
            $errors['confirm'] = 'Your passwords does not match each other!';
        }
        else if (strlen($password) < 8) {
            $errors['password'] = 'Please enter at least 8 characters long password!';
        }

        if (empty($errors)) {
            $paswordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare('INSERT INTO users(email, password) VALUES (:email, :password)');
            $result = $stmt->execute([
                'email' => $email, 
                'password' => $paswordHash
            ]);

            if($result) {
                $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
                $stmt->execute([
                    'email' => $email
                ]);
                $user_id = (int) $stmt->fetchColumn();
            
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                header('Location: index.php');
            }
            else {
                $errors['save_user'] = 'Something went wrong! User was not created!';
            }
        }
    }
?>

<main class="container">
    <h1 class="text-center">Registration form</h1>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger text-center">
            <p class="mb-1"><?php echo 'There are some errors in your registration form!'; ?></p>
            <a href="index.php"><i class="fas fa-arrow-left mr-2"></i>Go Back</a>
        </div>
    <?php endif; ?>
    <p class="mb-0">Do you already have an account?</p>
    <a class="btn btn-outline-info" href="login.php">Login</a>
    <form class="registration-form mb-2" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?php echo @$_POST['email']; ?>" placeholder="Enter email address" name="email" id="email">
            <?php if(isset($errors['email'])): ?>
                <small class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $errors['email']?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" placeholder="Enter password" name="password" id="password" type="password">
            <?php if(isset($errors['password'])): ?>
                <small class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $errors['password']?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="confirm">Confirm password</label>
            <input class="form-control <?php echo isset($errors['confirm']) ? 'is-invalid' : ''; ?>" placeholder="Confirm your password" name="confirm" id="confirm" type="password">
            <?php if(isset($errors['confirm'])): ?>
                <small class="error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $errors['confirm']?>
                </small>
            <?php endif; ?>
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-dark" type="submit">Submit Registration</button>
        </div>
    </form>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>