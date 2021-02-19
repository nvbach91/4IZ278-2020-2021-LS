<?php
$logo = 'facebook-logo.png';
$firstName = 'Denny';
$lastName = 'Nguyen';
$role = 'CTO';
$company = 'Facebook';
$phone = '+420 690 069 609';
$email = 'denny.nguyen@facebook.com';
$website = 'www.facebook.com';
$street = 'Ulická';
$propertyNumber = 420;
$orientationNumber = 69;
$city = 'Ostravo';
$zipCode = '420 00';

$address = "$street $propertyNumber/$orientationNumber, $city $zipCode";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Business card</title>
  <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <main class="container">
        <h1 class="header">My Business Card in PHP</h1>
        <div class="business-card">
          <div class="info">
              <div class="firstname"><?php echo $firstName; ?></div>
              <div class="lastname"><?php echo $lastName; ?></div>
              <div class="title"><?php echo $role; ?></div>
              <div class="company"><?php echo $company; ?></div>
          </div>
            <div>
                <img class="logo" src="./assets/img/<?php echo $logo; ?>"></img>
            </div>
        </div>
        <div class="business-card">
          <div class="contacts">
              <div class="address"><?php echo $address; ?></div>
              <div class="phone"><?php echo $phone; ?></div>
              <div class="email"><?php echo $email; ?></div>
              <div class="website"><?php echo $website; ?></div>
          </div>
            <div>
                <div class="firstname"><?php echo $firstName; ?></div>
                <div class="lastname"><?php echo $lastName; ?></div>
                <div class="title"><?php echo $role ?></div>
            </div>
        </div>
    </main>
</body>

</html>