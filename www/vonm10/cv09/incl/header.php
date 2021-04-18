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

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="https://eso.vse.cz/~vonm10/cv06/index.php">Beard With Me</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="https://eso.vse.cz/~vonm10/cv06/index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://eso.vse.cz/~vonm10/cv06/login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://eso.vse.cz/~vonm10/cv06/registration.php">Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://eso.vse.cz/~vonm10/cv06/admin.php">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://eso.vse.cz/~vonm10/cv06/world-clock.php">World Clock</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>