<?php


//komentar
$name = 'string';//retezec
$age = 12;//integer
$points = 10.5;//float
$deceased = false;//boolean true nebo false
$person = ['name'=> $name,
'age'=>$age,];
//objekt pole

$fruits = ['orange','apple','berry'];
$nothing = null;


echo 'Ahoj svete';
echo $name; 
echo $age;
$street = 'americka';
$number = '1000/5';
$city = 'praha';

//$address = $street.''. $number .','.$city;
$address = "$street $number, $city";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $address;?></title>
</head>
<body>
    
</body>
</html>