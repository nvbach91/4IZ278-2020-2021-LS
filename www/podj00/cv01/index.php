<?php

$name = 'John';
$surname = 'Wick';
$age = '40';
$profession = 'Hitman';
$firm = 'Onmyown';
$email = 'lovemydog@wick.com'

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <h1 class="center">My business card</h1>
    <div class="center cardBackground">
    <div class="container">
    <div class="left">
        <img class="logo" width="200" src="./john.png" alt="john">
    </div>
    <div class="right">
            <div class="name">
            John Wick
            </div>
            <div class="name">
            Best hitman possible!
            <br> (Also dog lover)
            </div>
    </div>
    </div>
    <div class="row">
    </div>
    <div class="backSize">
    <div class="center cardBackground">
    <div class="container">
    <div class="left">
        <img class="logo" width="200" src="./john.png" alt="john">
    </div>
    <div class="right">
            <div class="name">
            <?php echo "Name: $name"?> <?php echo $surname?> <br>  <?php echo "Age: $age"?> <br> <?php echo "Profession: $profession"?> <br> <?php echo $email?> <br>
            </div>
    </div>
    </div>
    <div>
</body>
</html>