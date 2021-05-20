<?php
if (session_status() != 2) {
    session_start();
}
// get user data from fb
if (isset($_SESSION['fb_access_token'])) {
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../facebook-login/config.php';

    $fb = new \Facebook\Facebook(array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']]));
    try {
        $me = $fb->get('/me')->getGraphUser();
        $picture = $fb->get('/me/picture?redirect=false&height=200')->getGraphUser();
        $email = $fb->get('/me?locale=en_US&fields=email')->getGraphUser();
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
        <a href="index.php">
            <img class="logo" src="./img/logo.PNG" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link<?php echo strpos($_SERVER['REQUEST_URI'], 'index') || preg_match('/\/$/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active active-cart' : '' ?>" href="cart.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </a>
                </li>
                <?php if (isset($_SESSION['fb_access_token']) && isset($_SESSION['access_token_expiries'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle<?php echo strpos($_SERVER['REQUEST_URI'], 'my_orders') || strpos($_SERVER['REQUEST_URI'], 'account_details') ? ' active' : '' ?>" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $picture['url']; ?>" alt="" class="nav-profile-image" />
                            <?php echo htmlspecialchars($me->getName(), ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="my_orders.php">My Orders</a></li>
                            <li><a class="dropdown-item" href="account_details.php">Account details</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href="components/logout.php"><i class="fas fa-sign-out-alt"></i>Sign out</a>
                            </li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link<?php echo strpos($_SERVER['REQUEST_URI'], 'signin') ? ' active' : '' ?>" href="signin.php">Sign in</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>