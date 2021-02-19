<?php

// tohle je komentar

/*
viceradkovy komentar
*/

// datovy typ retezec string
$name = 'string';
// datovy typ integer
$age = 12;
// datovy typ double/float
$points = 10.5;
// datovy typ boolean / true nebo false
$deceased = false;
// datovy typ objekt/pole - asociativni pole
$person = [
    'name' => $name,
    'age' => $age,
];
// jednoduche pole
$fruits = ['orange', 'apple', 'berry'];

// echo 'Ahoj svete, Ahoj';
// echo $name;
// echo $points;

$street = 'Americka';
$number = '1000/5';
$city = 'Praha';

// $address = $street . ' ' . $number . ', ' . $city;

$address = "$street $number, $city";


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
    <h1>My first web page in PHP</h1>
    <div><?php echo $name; ?></div>
    <div><?php echo $address; ?></div>
</body>
</html>

