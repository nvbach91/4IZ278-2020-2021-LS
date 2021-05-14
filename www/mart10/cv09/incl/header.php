<?php
if (session_id() == '') {
    session_start();
}

$page = basename($_SERVER['PHP_SELF']);
$basePrivilegeAllowed = ' signup login';

if (!@$_SESSION['user_privilege'] && !(strpos($page,'index.php') !== false || strpos($page,'login.php') !== false || strpos($page,'signup.php') !== false) ) {
    header('Location: login.php');
    die();
}
if (@$_SESSION['user_privilege'] == 1 && (strpos($page,'create-item.php') !== false || strpos($page,'edit-item.php') !== false || strpos($page,'delete-item.php') !== false)) {
    header('Location: index.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="fish">
    <meta name="author" content="Tadeáš Maršík">
    <title>Unhygienix | Village Fishmonger</title>
    <link rel="shortcut icon" href="https://static.thenounproject.com/png/12334-200.png">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="<?php echo isset($contextPath) ? $contextPath : '.'; ?>/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <img class="logo" src="https://static.thenounproject.com/png/12334-200.png" alt="logo">
            <a class="navbar-brand" href="#">Je čerstvá!</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href=".">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                    <?php if (isset($_SESSION['user_email'])): ?>
                    <li class="nav-item">
                        <li><a class="nav-link" href="profile.php">My account</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Sign up</a>
                    </li>
                    <?php endif; ?>
                    <?php if (@$_SESSION['user_privilege'] == 3): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>