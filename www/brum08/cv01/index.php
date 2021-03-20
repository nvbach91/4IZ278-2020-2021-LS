<?php
$name = 'Michael';
$lastName = 'Brůna';
$age = '21';
$position = 'Developer';
$company = 'Brůna s.r.o';
$street = 'Hunacova';
$streetNum = '15';
$town = 'Smržovka';
$phone = '123456789';
$email = 'miskobruna@gmail.com';
$avaibility = 'avaible';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Vizitka</title>
    <link rel="stylesheet" href="./css.css">
</head>

<body>
    <div class="border">
        <h1><?php echo $company ?></h1>
        <p><?php echo $name . ' ' . $lastName ?></p>
        <p><?php echo $age ?></p>
        <p><?php echo $street . ' ' . $streetNum . ' ' . $town ?></p>
        <p><?php echo $phone ?></p>
        <p><?php echo $email ?></p>
        <h3><?php echo $avaibility ?></h3>
</body>

</html>