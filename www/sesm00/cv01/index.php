<?php


$logo = 'battery.png';
$jmeno = 'Test';
$prijmeni = 'Tester';
$pozice = 'Testovací / Tester';
$spolecnost = 'Battery inc';
$telefon = '+420 222 333 444';
$mail = 'test@battery.com';
$web = 'www.battery.com';
$ulice = 'Ulicová';
$popisne = 23;
$orientacni = 189;
$mesto = 'Testering';


$adresa = $ulice . ' ' . $popisne . '/' . $orientacni . ', ' . $mesto;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vizitka</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="card-block">
        <div class="card card-top">
            <div class="card-left">
                <img src="./img/<?php echo $logo; ?>"/>
            </div>
            <div class="card-right">
                <p><?php echo $jmeno; ?></p>
                <p><?php echo $prijmeni; ?></p>
                <p><?php echo $pozice; ?></p>
                <p><?php echo $spolecnost; ?></p>
                <p><?php echo $telefon; ?></p>
                <p><?php echo $mail; ?></p>
                <p><?php echo $web; ?></p>
                <p><?php echo $adresa; ?></p>
            </div>
        </div>
        <div class="space"></div>
        <div class="card card-back">
            <img src="./img/<?php echo $logo; ?>"/>
        </div>
    </div>

</body>

</html>