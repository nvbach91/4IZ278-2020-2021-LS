<?php

use cv06\database\EshopDatabase;

$categories = EshopDatabase::instance()->findAllCategories();
$slides = EshopDatabase::instance()->findAllSlides();

    if (isset($_GET["category"]) && is_numeric($_GET["category"])) {
        $products = EshopDatabase::instance()->findAllProductsByCategory((int) $_GET["category"]);
    }
    else {
        $products = EshopDatabase::instance()->findAllProducts();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <title>Květinářství u Elišky</title>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand">Květinářství u Elišky</a>
            </div>
        </nav>

    <aside>
        <?php require __DIR__ . "/categories.php"; ?>
    </aside>

    <div class="container">
        <header>
            <?php require __DIR__ . "/slides.php" ?>
        </header>
        <main>
            <?php require __DIR__ . "/products.php" ?>
        </main>
    </div>
</body>
</html>