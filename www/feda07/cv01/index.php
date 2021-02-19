<?php
$jmeno = 'ALEXANDRA';
$prijmeni = 'FEDINA';
$povolani = 'Reklamní manažer';
$firma = 'Styling';
$cinnost = 'REKLAMA';
$adresa = 'Vavilova 69/2';
$mesto = 'Rostov-na-Donu';
$tel = '+420777666555';
$mail = 'alex-dzhan@vse.cz';
$web = 'https://styling.alexdzan.cz';
?>




<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $firma ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,200&display=swap');
    </style>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <div class="strana-prvni">
            <h1 class="firma-prvni"><?php echo $firma ?></h1>
            <div>
                <img class="logo" src="img.png" alt="logo">
            </div>
            <h1 class="firma-prvni"><?php echo $cinnost ?></h1>
        </div>
        <div class="strana-druha">
            <div class="col">
                <div class="ja">
                    <h1> <?php echo $jmeno ?> <?php echo $prijmeni ?> - <?php echo date_diff(date_create("30.01.2001"), date_create('now'))->y; ?> let</h1>
                    <h2> <?php echo $povolani ?> </h2>
                </div>
            </div>
            <div class="col">
                <div class="info">
                    <p>Adresa: <?php echo $adresa ?>,</p>
                    <p> <?php echo $mesto ?></p>
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