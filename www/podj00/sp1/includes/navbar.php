<?php
if (session_status() != 2) {
    session_start();
}

$query = $_SERVER['PHP_SELF'];
$path = pathinfo($query);
$currentPage = $path['basename'];

if (isset($_SESSION['fb_access_token'])) {
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../facebook/config.php';

    $fb = new \Facebook\Facebook(array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']]));
    try {
        $profilePic = $fb->get('/me/picture?redirect=false&height=200')->getGraphUser();
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}

?>

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" id="nav">
        <div class="container-fluid">
            <a href="index.php">
                <img src="img/logo.png" alt="logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == "index.php" ? " active" : '' ?>" href="index">Domů</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == "gym.php" ? " active" : '' ?>" href="gym">Posilovny</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == "lectures.php" ? " active" : '' ?>"
                           href="lectures">Lekce</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == "coaches.php" ? " active" : '' ?>"
                           href="coaches">Trenéři</a>
                    </li>

                    <?php if (!isset($_SESSION['logged_user']) && !isset($_SESSION['fb_access_token'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentPage == "login.php" ? " active" : '' ?>"
                               href="login">Přihlásit se</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['fb_access_token']) && isset($_SESSION['access_token_expiries']) || isset($_SESSION['logged_user'])) : ?>
                        <li class="nav-item dropdown">
                            <?php if (isset($_SESSION['logged_user'])) : ?>
                                <div class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                     data-bs-toggle="dropdown" aria-expanded="false">
                                    <a>
                                        <?php echo $_SESSION['logged_user']; ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo $profilePic['url']; ?>" alt="" class="profilePicture"/>
                                </a>
                            <?php endif; ?>
                            <div class="dropdown-menu dropdownLeft" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="mylectures">Mé lekce <i class="fas fa-dumbbell"></i></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="utils/logout">Odhlásit se</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
    </nav>