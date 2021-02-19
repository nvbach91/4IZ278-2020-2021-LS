<?php
$logo = 'logo.svg';
$name = 'Lukáš';
$surName = 'Frajt';
$age = '23';
$position = 'Accessibility developer';
$company = 'SAP Concur';
$city = 'Praha';
$street = 'Bucharova';
$propertyNumber = '2817';
$orientationNumber = '11';
$phoneNumber = '123 456 789';
$email = 'email@sap.com';
$web = 'https://www.concursolutions.com';
$available = false;

$address = "$street $propertyNumber/$orientationNumber, $city";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="container">
    <h1 class="text-center">My business card</h1>
    <div class="business-card business-card__front row">
        <div class="col-sm-4">
            <img class="bc-logo" src="./img/<?php echo $logo?>" alt="logo">
        </div>
        <div class="col-sm-8">
            <div class="bc-firstname"><?php echo $name; ?></div>
            <div class="bc-surname"><?php echo $surName; ?></div>
            <div class="bc-position"><?php echo $position; ?></div>
            <div class="bc-company"><?php echo $company; ?></div>
        </div>
    </div>

    <div class="business-card business-card__back row">
        <div class="col-sm-6">
            <div class="bc-firstname"><?php echo $name; ?></div>
            <div class="bc-surname"><?php echo $surName; ?></div>
            <div class="bc-title"><?php echo $position ?></div>
        </div>
        <div class="col-sm-6 contacts">
            <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></div>
            <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $phoneNumber; ?></div>
            <div class="bc-email"><i class="fas fa-at"></i> <?php echo $email; ?></div>
            <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $web; ?></div>
            <div class="bc-available"><?php echo $available ? 'Available for contracts': 'Not available for contracts'; ?></div>
        </div>
    </div>
</div>
</body>
</html>
