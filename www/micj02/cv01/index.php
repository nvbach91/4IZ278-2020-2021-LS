<?php
$name = 'Tony';
$surname = 'Stark';
$full_name = "$name $surname";
$street = 'Americka';
$number = '1000/5';
$city = 'Praha';
$adress = "$street $number, $city";
$phone = '+420 123 123 123';
$mail = 'tony@stark.indistries.com';
$website = 'www.stark.com';
$image = 'https://dailysuperheroes.com/wp-content/uploads/2020/02/tony-stark.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<section>
    <img src="<?php echo $image ?>" alt="profile picture"/>
    <div>
        <h2><?php echo $full_name ?></h2>
        <hr/>
        <ul>
            <li><?php echo $adress ?></li>
            <li><?php echo $phone ?></li>
            <li><?php echo $mail ?></li>
            <li><?php echo $website ?></li>
        </ul>
    </div>
</section>

</body>
</html>