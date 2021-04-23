<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>MangoStore</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <img src="https://eso.vse.cz/~nguv03/cv08/img/logo.png" width="30" height="30" alt="">
        <a class="navbar-brand" href="index.php">MangoStore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'index') ? ' active' : '' ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="signout.php">Logout</a>
                    </li>
                    <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>">
                        <a class="nav-link" href="signin.php">Login</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>