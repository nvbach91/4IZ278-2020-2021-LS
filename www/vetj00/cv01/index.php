<?php

//variables

$avatar = 'profilovka.jpg';
$firstName = 'Jan';
$lastName = 'Větrovský';
$age = 21;
$job = 'Web developer';
$company = 'Such development company';
$email = 'vetrovsky.jan@gmail.com';
$phone = '+420773201372';
$webPage = 'eso.vse.cz/~vetj00/cv01';
$street = 'Jažlovická';
$entryNumber = 1330;
$zip = '149 00';
$city = 'Prague';

$address = $street . ' ' . $entryNumber . ', ' . $city . ', ' . $zip;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My card</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>My card in PHP</h1>
    <div class="front">
        <img width="300" alt="logo" class="logo" src="./img/<?php echo $avatar; ?>">
        <div class="personal">
            <div class="name"><?php echo $firstName; ?></div>
            <div class="last-name"><?php echo $lastName; ?></div>
            <div class="job"><?php echo $job; ?></div>
            <div class="company"><?php echo $company; ?></div>
        </div>
    </div>
    <div class="back">
        <div class="back-name">
            <div class="name"><?php echo $firstName; ?></div>
            <div class="last-name"><?php echo $lastName; ?></div>
            <div class="job"><?php echo $job ?></div>
        </div>
        <div class="back-data">
            <div><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></div>
            <div><i class="fas fa-phone"></i> <?php echo $phone; ?></div>
            <div><i class="fas fa-at"></i> <?php echo $email; ?></div>
            <div><i class="fas fa-globe"></i> <?php echo $webPage; ?></div>
        </div>
    </div>
</body>
</html>