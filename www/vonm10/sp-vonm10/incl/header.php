<?php require_once __DIR__ . '/../config/global.php'; ?>
<?php

@session_start();
if (!isset($_SESSION)) {
    $login = false;
} elseif (isset($_SESSION)) {
    if (!isset($_SESSION['login'])) {
        $login = false;
    } elseif ($_SESSION['login'] == false) {
        $login = false;
    } else {
        $login = true;
    }
}


if (!isset($_SESSION)) {
    $admin = false;
} elseif (isset($_SESSION)) {
    if (!isset($_SESSION['admin'])) {
        $admin = false;
    } elseif ($_SESSION['admin'] == 1) {
        $admin = false;
    } else {
        $admin = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Beard With Me</title>
    <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/293/293400.png">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="<?php echo isset($contextPath) ? $contextPath : '.'; ?>/css/styles.css">
</head>

<body style="
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    padding-top: 0px;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="https://eso.vse.cz/~vonm10/beardwithme/index.php">Beard With Me</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="https://eso.vse.cz/~vonm10/beardwithme/index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href=<?php echo URL . '/products/category.php?categoryId=1' ?>>Care</a>
                        <a class="dropdown-item" href=<?php echo URL . '/products/category.php?categoryId=2' ?>>Wash</a>
                        <a class="dropdown-item" href=<?php echo URL . '/products/category.php?categoryId=3' ?>>Brush and Comb</a>
                        <a class="dropdown-item" href=<?php echo URL . '/products/category.php?categoryId=4' ?>>Sets</a>
                    </div>
                </li>

                <? if ($login) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="https://eso.vse.cz/~vonm10/beardwithme/logout.php">Logout</a>
                    </li>
                <? else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="https://eso.vse.cz/~vonm10/beardwithme/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://eso.vse.cz/~vonm10/beardwithme/registration.php">Registration</a>
                    </li>
                <? endif; ?>

                <? if ($admin) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="https://eso.vse.cz/~vonm10/beardwithme/admin.php">Admin</a>
                    </li>
                <? endif; ?>
                <li class="nav-item">
                        <a class="nav-link" href="https://eso.vse.cz/~vonm10/beardwithme/products/cart.php">Cart</a>
                    </li>
            </ul>
        </div>
    </nav>