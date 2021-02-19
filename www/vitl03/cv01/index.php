<?php
$firstName = 'Lukáš';
$lastName = 'Vít';
$fullName = "$firstName $lastName";
$street = 'Budějovická 11';
$city = 'Benešov';
$zip = '141 21';
$address = "$street, $city, $zip";
$email = 'vitl03@vse.cz';
$phone = '773 829 012';
$web = 'www.nekde.cz';
$availableForOffers = false;
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styly.css">
    <title>Vizitka</title>
</head>

<body>

    <div class="first-side">
        <div class="color-part">
            <div class="black1"></div>
            <div class="orange1"></div>
            <div class="orange2"></div>
            <div class="black2"></div>
        </div>
        <div class="name-part">
            <img class="logo" src="img/logoLV_white.png" alt="logo">
            <h1>
                <strong>Lukáš Vít</strong>
            </h1>
            <h3>Web application developer</h3>
        </div>
    </div>
    <div class="second-side">
        <div class="color-part">
            <div class="black1"></div>
            <div class="orange1"></div>
            <div class="orange2"></div>
            <div class="black2"></div>
        </div>
        <div class="info-part">

            <div class="name">
                <h2> <?php echo $fullName; ?></h3>
            </div>

            <div class="address">
                <h3 class="info">Address </h3>
                <p>
                    <?php echo $address; ?>
                </p>

            </div>
            <div class="phone">
                <h3>Phone </h3>
                <p>
                    <?php echo $phone; ?>
                </p>

            </div>
            <div class="email">
                <h3>Email </h3>
                <p>
                    <?php echo $email; ?>
                </p>

            </div>
            <div class="web">
                <h3>Web </h3>
                <p>
                    <?php echo $web; ?>
                </p>

            </div>
            <div class="offers">
                <h3>Available for offers </h3>
                <p>

                    <?php echo $availableForOffers ? 'Yes':'No'; ?>
                </p>

            </div>

        </div>
    </div>
</body>

</html>