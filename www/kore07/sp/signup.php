<?php require_once __DIR__ .'/utils/utils.php'; ?>
<?php require_once __DIR__ .'/database/UsersDB.php'; ?>
<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $usersDB = new UsersDB();
    $errors = [];

    $submittedForm = (!empty($_POST) && ('POST' == $_SERVER['REQUEST_METHOD']));

    if ($submittedForm) {
        $name = trim(@$_POST['name']);
        $email = trim(@$_POST['email']);
        $password = trim(@$_POST['password']);
        $confirm = trim(@$_POST['confirm']);

        if ($password !== $confirm) {
            $errors['password'] = 'Your passwords do not match';
        }

        if (strlen($password) < 5 || strlen($confirm) < 5) {
            $errors['password'] = 'Please use at least 5 characters';
        }

        $existing_user = $usersDB->fetchBy('user_email', $email);

        if ($existing_user) {
            $errors['email'] = 'User with this email is already existed';
        }

        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $data = [
                'user_name' => $name,
                'user_email' => $email,
                'user_hashedPassword' => $hashedPassword,
            ];
    
            $usersDB->create($data);
            
            sendEmail($email, 'Registration confirmation');
            header('Location: signin.php?email=' . $email);
        }

    }
?>


<?php require __DIR__ . '/includes/header.php' ?>

<main class="main">
    <section class="signup-popup form-section">
        <h1 class="popup-title">Sign Up</h1>
        <?php if ($submittedForm && !empty($errors)): ?>
            <div class="popup-alert alert alert-danger">
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <form class="popup-form sign-form" method="post" action="">
            <div class="popup-container">
                <p class="popup-input">
                <label for="name">Full name:</label>
                <input type="text" name="name" id="name" placeholder="Lisa Tompson" value="<?php echo @$name; ?>" required/>
                </p>

                <p class="popup-input">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="email@example.com" value="<?php echo @$email; ?>" required/>
                </p>

                <p class="popup-input">
                <label for="password">Please use at least 5 characters:</label>
                <input type="password" name="password" id="password" placeholder="perfectpasswordever" value="<?php echo @$password; ?>" required/>
                </p>

                <p class="popup-input">
                <label for="confirm">Confirm password:</label>
                <input type="password" name="confirm" id="confirm" placeholder="perfectpasswordever" required/>
                </p>
            </div>

            <button class="button popup-button" type="submit">Sign up</button>
        </form>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php' ?>
