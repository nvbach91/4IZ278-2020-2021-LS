<?php

$home = BASE_URL;

$login = BASE_URL . 'login';

$isLoginShowed = urlMatchPath($login, getCurrentUrl());
$cartMsgs = array();

$userLogged = User::isUserLoggedIn();

if (isset($_POST['action']) && $_POST['action'] == "logout") {
    if ($userLogged) {
        setcookie("user", "", 0, getCookiePath());
        header('Location: ' . getBaseUrl());
        die();
    }
}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo getBaseUrl(); ?>">Česká dálnice CZ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item<?php if (getCurrentUrl() == $home) : echo ' active'; endif; ?>">
                    <a class="nav-link" href="<?php echo $home; ?>">Home
                        <?php if (getCurrentUrl() == $home) : ?>
                            <span class="sr-only">(current)</span>
                        <?php endif; ?>
                    </a>
                </li>
                <?php if (!$userLogged): ?>
                    <li class="nav-item<?php if ($isLoginShowed) : echo ' active'; endif; ?>">
                        <a class="nav-link" href="<?php echo $login; ?>">Přihlášení</a>
                    </li>
                <?php else: ?>
                    <?php
                        $cartController = new CartController();
                        echo $cartController->performAction();
                        $cartMsgs = $cartController->getMessages();
                    ?>
                    <form method="post" class="form-inline my-2 my-lg-0">
                        <input type="hidden" name="action" value="logout">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Odhlásit se</button>
                    </form>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>