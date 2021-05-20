<?php require __DIR__ . '/incl/header.php' ?>
<?php require __DIR__ . '/incl/navbar.php' ?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/facebook-login/config.php';
$fb = new \Facebook\Facebook(CONFIG_FACEBOOK);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl(CONFIG_PROTOCOL . CONFIG_DOMAIN . CONFIG_PATH . '/fb-login-callback.php', $permissions);
?>

<main class="container d-flex flex-column align-items-center justify-content-center sign-in">
    <i class="fab fa-facebook-f fa-5x"></i>
    <a class="btn btn-primary" href="<?php echo htmlspecialchars($loginUrl); ?>">Log in with Facebook!</a>
    <p>Please signin to continue. You will be redirected to Facebook. Once you will signin on Facebook, you will be redirected back to G-SHOP.</p>
</main>

<?php require __DIR__ . '/incl/footer.php' ?>