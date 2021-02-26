<?php
$name = 'ALEXANDRA';
$surname = 'FEDINA';
$myJob = 'Reklamní manažer';
$company = 'Styling';
$department = 'REKLAMA';
$address = 'Vavilova 69/2';
$city = 'Rostov-na-Donu';
$tel = '+420777666555';
$mail = 'alex-dzhan@vse.cz';
$web = 'https://styling.alexdzan.cz';

$age = date_diff(date_create("30.01.2001"), date_create('now'))->y;
?>


<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $company ?></title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
<div class="container">
    <div class="first-page">
        <h1 class="company-first"><?php echo $company ?></h1>
        <div>
            <img class="logo" src="img.png" alt="logo">
        </div>
        <h1 class="company-first"><?php echo $department ?></h1>
    </div>
    <div class="second-page">
        <div class="col">
            <div class="me">
                <h1> <?php echo $name ?> <?php echo $surname ?> - <?php echo $age ?> let</h1>
                <h2> <?php echo $myJob ?> </h2>
            </div>
        </div>
        <div class="col">
            <div class="info">
                <p>Adresa: <?php echo $address ?>,</p>
                <p> <?php echo $city ?></p>
                <p> Tel: <?php echo $tel ?></p>
                <p> E-mail: <?php echo $mail ?></p>
                <p> Web: <?php echo $web ?></p>
                <p> dostupná k pracovním nabídkám </p>
            </div>
        </div>
    </div>
</div>

</body>

</html>