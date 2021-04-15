<?php

$home = BASE_URL;
$admin = BASE_URL . 'admin';
$login = BASE_URL . 'login.php';
$isAdminShowed = urlMatchPath($admin, getCurrentUrl());
$cartMsgs = array();

if (isset($_POST['action']) && $_POST['action'] == "logout") {
    setcookie("name", "");
    unset($_COOKIE["name"]);
}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Super bazar</a>
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
                <li class="nav-item<?php if ($isAdminShowed) : echo ' active'; endif; ?>">
                    <a class="nav-link" href="<?php echo $admin; ?>">Admin</a>
                    <?php if ($isAdminShowed) : ?>
                        <span class="sr-only">(current)</span>
                    <?php endif; ?>
                </li>
                <?php if (!isset($_COOKIE['name'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $login; ?>">Přihlášení</a>
                    </li>
                <?php else: ?>
                    <?php include __DIR__ . '/cart.php'; ?>
                    <form method="post" class="form-inline my-2 my-lg-0">
                        <input type="hidden" name="action" value="logout">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Odhlásit se</button>
                    </form>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>