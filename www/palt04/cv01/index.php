<?php

    $avatar = 'avatar.jpg';                 
    $firstName = 'Timotej';
    $lastName = 'Paluš';
    $title = 'QA Engineer';
    $company = 'Marius pedersen';
    

    $phone = '+421 999 333 222';
    $email = 'chosenone@jedi-council.com';
    $website = 'www.nike.com';
    $available = false;                         
    $street = 'kunratice';
    $propertyNumber = 77;                       
    $orientationNumber = 120;
    $city = 'Praha';
    
    // string concatenation
    $address = $street . ' ' . $propertyNumber . '/' . $orientationNumber . ', ' . $city;
    
    // string variable interpolation
    $address = "$street $propertyNumber/$orientationNumber, $city";
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>My business card</h1>
    <main class="container">
        <div class="bs-card">
            <div class="logo" style="background-image: url(img/<?php echo $avatar; ?>)"></div>
            <div class= "bs-body">
                <p><?php echo $firstName; ?></p>
                <p><?php echo $lastName; ?></p>
                <p><?php echo $title; ?></p>
                <p><?php echo $company; ?></p>
                <p><?php echo $address; ?></p>
                <p><?php echo $phone; ?></p>
                <p><?php echo $email; ?></p>
                <p><?php echo $website; ?></p>
                <p><?php echo $available ? 'Not available for contracts' : 'Now available for contracts'; ?></p>
            </div>
        </div>
    </main>
</body>
</html>