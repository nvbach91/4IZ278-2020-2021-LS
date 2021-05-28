<?php require_once __DIR__ . '/class/UsersDB.php'; ?>
<?php


require_once __DIR__ . '/vendor/autoload.php';
?>
<?php

if (isset($_SESSION['access_token']) || isset($_SESSION['user_id'])) {
    header('Location: index.php?page=profile');
}
$invalidInputs = [];
$errors = [];
$msg = '';
$msgClass = '';

$usersDB = new UsersDB();


if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = htmlspecialchars(trim(($_POST['email'])));
    $password = htmlspecialchars(trim(($_POST['password'])));

    if (!$email) {
        array_push($invalidInputs, 'Email is empty');
        $msg = 'Email is empty';
        $msgClass = 'alert-danger';
    }

    if (!$password) {
        array_push($invalidInputs, 'Password is empty');
        $msg = 'Password is empty';
        $msgClass = 'alert-danger';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email is in invalid format');
        $msg = 'Email is in invalid format';
        $msgClass = 'alert-danger';
    }

    if (empty($invalidInputs)) {
        $isExistingUser = false;

        $userRecords =  $usersDB->fetchAll();

        foreach ($userRecords as $userRecord) {
            if (!$userRecord) {
                continue;
            }
            if ($userRecord['email'] == $email) {
                $isExistingUser = true;
                break;
            }
        }

        if ($isExistingUser) {
            array_push($errors, 'User already exists');
            $msg = 'User already exists';
            $msgClass = 'alert-danger';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $usersDB->insert($email, $hashedPassword);

            header('Location: index.php');
        }
    }
}

$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$loginUrl = $fb->getRedirectLoginHelper()->getLoginUrl(LOGIN_CALLBACK_URL, ['email']);

if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '"class="google btn">
    <i class="fa fa-google fa-fw"></i> Sign up with Google
</a>';
}


?>


<?php include __DIR__ . '/includes/header.php' ?>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <br>
                <h2>Sign up</h2>
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
                    <button class="button-red text-uppercase" type="submit">Create account</button>
                </form>
            </div>
            <div class="col-md-4">
                <br>
                <br>
                <a href="<?php echo $loginUrl; ?>" class="fb btn">
                    <i class="fa fa-facebook fa-fw"></i> Sign up with Facebook
                </a>

                <?php echo $login_button; ?>


            </div>
        </div>
    </div>
    <div style="margin-bottom: 600px"></div>


    <?php include __DIR__ . '/includes/footer.php' ?>