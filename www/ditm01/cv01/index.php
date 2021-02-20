<?php

$avatar = 'batman_logo.png';
$lastname = 'Wayne';
$firstname = 'Bruce';
$secondname = 'Thomas';
$profession = 'superhero';
$company = 'Wayne Enterprises';
$street = 'Batcave';
$propertybumber = 12;
$orientationnumber = 9;
$city = 'Gotham City';
$phone = '(555) 555-1234';
$email = 'batman@justiceleague.com';
$web = 'justiceleague.com';
$availability = 'Available for serving justice';


$fulladdress = $street . ' ' . $propertybumber . '/' . $orientationnumber . ', ' . $city;
$fullname = $firstname . ' ' . $secondname . ' ' . $lastname;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Business Card</title>
</head>
<body>
    <div class ="all">
        <h1>I am Batman</h1>
        <div class="business-card">
            <div class="left-side">
                <div class="avatar">
                    <img class="logo" src ="./img/<?php echo $avatar; ?>">
                </div>
            </div>
            <div class="right-side">
                <div class="name"><?php echo $fullname; ?></div>
                <div class="profession"><?php echo $profession; ?></div>
                <div class="fulladdress"><?php echo $fulladdress; ?></div>
                <div class="phone"><?php echo $phone; ?></div>
                <div class="email"><?php echo $email; ?></div>
                <div class="web"><?php echo $web; ?></div>
                <div class="availability"><?php echo $availability; ?></div>
            </div>   
        </div>
    </div>
    
</body>
</html>