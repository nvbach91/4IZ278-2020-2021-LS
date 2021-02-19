<?php

$street = 'Nademlejnska';
$number = '20';
$city = 'Praha';

$address = "$street, $number, $city";

$logoPath = 'logo.png';

$name = 'Petr Klepetko';
$phone = '602149444';
$mail = 'klepetkope@gmail.com';
$birthDay = 19;
$birthMonth = 11;
$birthYear = 1998;

$birthDate = "$birthDay. $birthMonth. $birthYear";
$countedAge = 2021 - $birthYear;

$company = 'Dáváme s. r. o.';
$web = 'eso.vse.cz/~klep03/cv01/';
$isAvailable = 'Jsem dostupný';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
</head>

<body>
    <div id="container">
        <h1>My business card</h1>
        <div id="front" class="card">
            <img src="<?php echo $logoPath ?>" alt="logo" height="80">

        </div>
        <div id="back" class="card">
            <div class="side">
                <p class="name"><?php echo $name ?></p>
                <p><?php echo $address ?></p>
                <p>Tel: <?php echo $phone ?></p>
                <p>E-mail: <?php echo $mail ?></p>
            </div>
            <div class="side">

                <p>Narození: <?php echo $birthDate ?></p>
                <p>Věk: <?php echo $countedAge ?></p>
                <p><?php echo $company ?></p>
                <p><?php echo $web ?></p>
                <p><?php echo $isAvailable ?></p>

            </div>
        </div>
    </div>
</body>

</html>