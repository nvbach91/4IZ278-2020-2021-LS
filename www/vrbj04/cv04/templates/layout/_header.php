<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FisHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $root ?? "." ?>/static/fishub.css">
    <style>
    </style>
</head>
<body>
<div class="container">
    <div class="mt-5 pb-5">
        <a href="<?= $root ?? "." ?>/index.php" class="d-block text-decoration-none">
            <h1 class="title">
                Fis<span class="title--hub">Hub</span>
            </h1>
        </a>
    </div>

    <?php require __DIR__ . "/_authentication.php"; ?>

    <div class="mt-5">