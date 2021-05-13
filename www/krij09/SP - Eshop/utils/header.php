<?php
if(isset($_GET['logout']))
{
    session_destroy();
    header("Location: ./");
}

?>
<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Eshop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="stylesheet" href="./css/custom.css">
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="./">Hruška Shop</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <input class="form-control form-control-dark w-50" type="text" placeholder="Search" aria-label="Search">
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <?php if(!isset($_SESSION['username'])): ?>
                    <a class="nav-link" href="./login.php">Přihlášení</a>
                    <?php else: ?>
                        <a class="nav-link" href="./userprofile.php">Uživatelský profil</a>
                    <?php endif; ?>

                </li>
            </ul>
        </header>


