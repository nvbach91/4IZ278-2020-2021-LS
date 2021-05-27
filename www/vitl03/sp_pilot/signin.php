<?php require_once __DIR__ . '/class/UsersDB.php'; ?>
<?php

require_once __DIR__ . '/vendor/autoload.php';

?>
<?php

if (isset($_SESSION['access_token'])) {
    header('Location: index.php?page=profile');
}



$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$loginUrl = $fb->getRedirectLoginHelper()->getLoginUrl(LOGIN_CALLBACK_URL, ['email']);


$invalidInputs = [];
$msg = '';
$msgClass = '';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $usersDB = new UsersDB();
    $existing_user = $usersDB->fetchUserByEmail($email);


    if (@password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['id'];
        $_SESSION['user_email'] = $existing_user['email'];
        $_SESSION['user_privilege'] = $existing_user['privilege'];

        if ($_SESSION['user_privilege'] == 3) {
            header('Location: index.php?page=admin');
        } else {
            header('Location: index.php?page=profile');
        }
    } else {
        $msg = 'Combination of email and password is incorrect';
        $msgClass = 'alert-danger';
    }
}





if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '"class="google btn">
    <i class="fa fa-google fa-fw"></i> Login with Google
</a>';
}


?>

<?php include __DIR__ . '/includes/header.php' ?>





<body>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <br>

                <h2>Sign in</h2>
                <br>
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

            <div class="col-md-4">
                <br>
                <br>
                <a href="<?php echo $loginUrl; ?>" class="fb btn">
                    <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                </a>

                <?php echo $login_button; ?>




            </div>
        </div>

    </div>

    <div style="margin-bottom: 600px"></div>
    <?php include __DIR__ . '/includes/footer.php' ?>