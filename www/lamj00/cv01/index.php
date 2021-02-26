
  
<?php

$avatar = 'logo.jpg';              
$firstName = 'Jan';
$lastName = 'Lampa';
$title = 'failed bachelor student';
$company = 'Bad company';
$phone = '+420 777 777 777';
$email = 'lamj00@vse.cz';
$website = 'www.lampicka.cz';
$available = false;                     
$street = 'Kostelecká';
$propertyNumber = 20;          
$orientationNumber = 100;
$city = 'Praha';

$address = $street . ' ' . $propertyNumber . '/' . $orientationNumber . ', ' . $city;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <main class="container">
        <h1 class="text-center">Business Card</h1>
        <div class="business-card bc-front row">
            <div class="col-sm-4">
                <div class="logo" style="background-image: url(./img/<?php echo $avatar; ?>)"></div>
                <div class="bc-firstname"><?php echo $firstName; ?></div>
                <div class="bc-lastname"><?php echo $lastName; ?></div>
                
            </div>
            <div class="col-sm-8">
            
                <div class="bc-title"><?php echo $title; ?></div>
                <div class="bc-company"><?php echo $company; ?></div>
            </div>
           
        </div>
        <div class="business-card bc-back row">
            <div class="col-sm-6">
                <div class="bc-firstname"><?php echo $firstName; ?></div>
                <div class="bc-lastname"><?php echo $lastName; ?></div>
                <div class="bc-title"><?php echo $title ?></div>
            </div>
            <div class="col-sm-6 contacts">
                <div class="bc-address"> <?php echo $address; ?></div>
                <div class="bc-phone"> <?php echo $phone; ?></div>
                <div class="bc-email"><?php echo $email; ?></div>
                <div class="bc-website"> <?php echo $website; ?></div>
                <div class="bc-available"><?php echo $available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
            </div>
        </div>
    </main>
    
    
</body>

</html>
