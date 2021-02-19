<?php


$name = 'Jakub';
$lastName = 'Bejvl';
$wholeName = $name . ' ' . $lastName;
$birthDate = new DateTime('1996/09/05');
$age = $birthDate->diff(new DateTime('now'))->y;
$position = 'Junior Software Developer';
$companyName = 'Rockwell Automation';
$street = 'U Retexu';
$number = 624;
$city = 'Klatovy';
$phone = '+420 724 852 164';
$personalMail = 'bejvl18@gmail.com';
$webPage = 'www.rockwellautomation.com';
$webPageLink = 'https://www.rockwellautomation.com';
$openToJobOffers = false;
$address = "$street $number, $city ";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vizitka</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1 class="text-center">My Busines Card in PHP</h1>
    <div class="content">
        <div class="card">
            <img src="img/logo.jpg" alt="logo společnosti">
            <div class="info">
                <h2>
                    <?php
                        echo $wholeName;
                    ?>
                </h2>
                <div class="personal">
                    <h3>Osobní</h3>
                    <div class="information">
                        <span class="heading">Věk:</span>
                        <span>
                            <?php
                                echo $age;
                            ?>
                        </span>
                    </div>
                    <div class="information">
                        <span class="heading">Adresa:</span>
                        <span>
                            <?php
                                echo $address;
                            ?>
                        </span>
                    </div>
                    <div class="information">
                        <span class="heading">E-mail:</span>
                        <span>
                            <?php
                                echo $personalMail;
                            ?>
                        </span>
                    </div>
                    <div class="information">
                        <span class="heading">Otevřen novým nabídkám:</span>
                        <span>
                            <?php
                                echo $openToJobOffers == true ? 'Ano' : 'Ne';
                            ?>
                        </span>
                    </div>
                </div>
                <div class="company">
                    <h3>Pracovní</h3>
                    <div class="information">
                        <span class="heading">Firma:</span>
                        <span>
                            <?php
                                echo $companyName;
                            ?>
                        </span>
                    </div>
                    <div class="information">
                        <span class="heading">Pozice:</span>
                        <span>
                            <?php
                                echo $position;
                            ?>
                        </span>
                    </div>
                    <div class="information">
                        <span class="heading">Web:</span>
                        <span>
                            <a href="<?php echo $webPageLink;?>">
                                <?php
                                    echo $webPageLink;
                                ?>
                            </a>
                        </span>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</body>
</html>
