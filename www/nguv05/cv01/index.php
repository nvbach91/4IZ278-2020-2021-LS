<?php 
// jednoradkovy komentar

/*
viceradkovy komentar
*/

// deklarace promennych
// prirazeni hodnoty
// hodnota je typu string / retezec
$name = 'James';
// datovy typ integer
$age = 41;
// datovy typ double/float
$points = 10.5;
// datovy typ boolean - true/false
$isMarried = true;
// datovy typ null
$nothing = null;
// pole
$fruits = ['avocado', 'orange', 'strawberry'];
// ascociativni pole
$person = [
    'name' => 'Maria',
    'age' => 42,
];

$street = 'Americka';
$number = '1000/4';
$city = 'Praha';
$zip = '10100';

$address = "$street $number, $city $zip";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ahoj <?php echo $name; ?></h1>
    <div><?php echo $address; ?></div>
</body>
</html>

