<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Magic mango</title>
    <link rel="shortcut icon" href="https://cdn.iconscout.com/icon/free/png-256/mango-fruit-vitamin-healthy-summer-food-31184.png">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Magic mango</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <?php if (isset($_SESSION['email']) && isset($_SESSION['user_privilege']) && $_SESSION['user_privilege'] == 3) : ?>
                        <li class="nav-item">
                        <li><a class="nav-link" href="users.php">Users</a>
                        </li>
                        <li class="nav-item">
                        <li><a class="nav-link" href="myAccount.php">My account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php elseif (isset($_SESSION['email']) && isset($_SESSION['user_privilege']) && $_SESSION['user_privilege'] != 3) : ?>
                        <li class="nav-item">
                        <li><a class="nav-link" href="myAccount.php">My account</a>
                        </li>
                        <li class="nav-item">   
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>