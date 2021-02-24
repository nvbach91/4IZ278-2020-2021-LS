<?php

$avatar = 'avatar.jpg';
$name = 'Matyas';
$surname = 'Vondra';
$age = 2021 - 2000;
$position = 'Junior Quality Analyst';
$company = 'Omio';

$street = 'Fake Street';
$number = '133/17';
$psc = '123 45';
$city = 'Prague';

$phone = '123 456 789';
$mail = 'vonm10@vse.cz';
$webpage = 'eso.vse.cz/~vonm10/cv01';
$availability = 'Not available.';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Business card</title>    
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class="card">
        <div class="firstRow">
            <div>
                <img src=<?php echo $avatar ?> width="50" height="50" alt="logo">
            </div>

            <div>
                <?php echo $name . " " . $surname . ", " . $age ?>
                <br>
                <?php echo $position ?>
                <br>
                <?php echo $company ?>
            </div>

            <div>

            </div>
            <?php echo "$street $number" ?>
            <br>
            <?php echo "$psc $city" ?>
        </div>

        <div class="secondRow">
            <br>
            <?php echo $phone ?>
            <br>
            <?php echo $mail ?>
            <br>
            <?php echo $webpage ?>
            <br>
            <?php echo $availability ?>
        </div>
    </div>
</body>


</html>