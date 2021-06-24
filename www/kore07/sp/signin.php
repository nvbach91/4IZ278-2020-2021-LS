<?php require_once __DIR__ . '/facebook/facebook-login.php' ?>
<?php
    if(!isset($_SESSION)){
        session_start();
    }

    require_once __DIR__ .'/database/UsersDB.php';

    $usersDB = new UsersDB();
    $errors = [];

    $submittedForm = (!empty($_POST) && ('POST' == $_SERVER['REQUEST_METHOD']));

    if ($submittedForm) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $existing_user = $usersDB->fetchBy('user_email', $email);

        if (!$existing_user) {
            $errors['isExisted'] = 'Wrong email, please check it again';
        }

        if (password_verify($password, $existing_user['user_password'])) {
            $_SESSION['user_id'] = $existing_user['user_id'];
            $_SESSION['user_email'] = $existing_user['user_email'];

            header('Location: index.php');
        } else {
            $errors['password'] = 'Wrong password, please check it again';
        }
    }
    
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
    } 
?>


<?php require __DIR__ . '/includes/header.php' ?>

<main class="main">
    <section class="signin-popup form-section">
        <h1 class="popup-title">Sign In</h1>
        <?php if ($submittedForm && !empty($errors)): ?>
            <div class="popup-alert alert alert-danger">
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <form class="popup-form sign-form" method="post">
            <div class="popup-container">
                <p class="popup-input">
                <label for="signin_email">E-mail:</label>
                <input type="email" name="email" id="signin_email" placeholder="email@example.com" value="<?php echo @$email; ?>"/>
                </p>

                <p class="popup-input">
                <label for="signin_password">Password:</label>
                <input type="password" name="password" id="signin_password" placeholder="perfectpasswordever" />
                </p>

                <a class="signin-popup-text popup-text signup-link" href="signup.php">Don't have an account? Sign up!</a>
                <a class="signin-popup-text popup-text signup-link" href="<?php echo htmlspecialchars($loginUrl); ?>">Log in with Facebook!</a>
            </div>

            <button class="button popup-button" type="submit">Sign in</button>
        </form>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php' ?>