<?php


//  koment

/*
    snad nevadi, ze jsem se inspiroval s HTML a CSS
    ucim se s anglickym layoutem klavesnice a slo mi to pomalu hrozne
*/

$logo = 'logo.png';
$surname = 'Marsik';
$name = 'Tad';

$birthdayDate = new DateTime('1998/01/09');
$currDate = new DateTime();
$age = $currDate->diff($birthdayDate)->y;

$occupation = 'Cook';
$company = 'Ichiraku Ramen';
$street = 'Delicious St.';
$propertyNumber = 420;                       // datatype number
$orientationNumber = 9;
$city = 'Fukuoka';
$phone = '+420 776 123 456';
$email = 'ramen@ichiraku.jp';
$website = 'www.ichiraku-ramen.jp';
$available = true;                         // data type boolean

$address = "$street $orientationNumber,  $city"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ichiraku Ramen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
        <h1 class="text-center">My Business Card in PHP</h1>
        <div class="card front row">
            <div class="col-sm-4">
                <div class="logo" style="background-image: url(<?php echo $logo; ?>)"></div>
            </div>
            <div class="col-sm-8">
                <div class="name"><?php echo $name; ?></div>
                <div class="surname"><?php echo $surname; ?></div>
                <hr/>
                <div class="occupation"><?php echo $occupation; ?></div>
                <div class="company"><?php echo $company; ?></div>
            </div>
        </div>
        <div class="card back row">
            <div class="col-sm-6">
                <div class="name"><?php echo $name; ?></div>
                <div class="surname"><?php echo $surname; ?></div>
                <div class="occupation"><?php echo $occupation ?></div>
                <div class="age"><?php echo $age ?></div>
            </div>
            <div class="col-sm contacts">
                <div class="address"><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></div>
                <div class="phone"><i class="fas fa-phone"></i> <?php echo $phone; ?></div>
                <div class="email"><i class="fas fa-at"></i> <?php echo $email; ?></div>
                <div class="website"><i class="fas fa-globe"></i> <?php echo $website; ?></div>
                <div class="available"><?php echo $available ? 'Now available for contracts' : 'Not available for contracts'; ?></div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>
</html>