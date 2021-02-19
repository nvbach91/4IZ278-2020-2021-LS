<?php

  $title = 'Business card';
  $logo = 'logo.svg';
  $firstname = 'Denis';
  $lastname = 'Akopyan';
  $title = 'Software Developer';
  $company = 'CADTeam s.r.o.';
  $phone = '+420 777 666 555';
  $email = 'myepicmail@gmail.com';
  $website = 'https://github.com/hailstorm75';
  $available = false;
  $address = 'Address';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enforces legacy IE browsers to display content in the highest mode available -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap style library reference -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <!-- Icons style library reference -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Custom style library reference -->
    <link rel="stylesheet" href="./css/style.css">

    <title><?php echo $title; ?></title>
</head>
<body>
<main class="container">
    <h1><?php echo $title; ?></h1>
    <div class="business-card-front bc-front row">
        <div class="col-sm">
            <div class="logo" style="background-image: url(./img/<?php echo $logo; ?>)"></div>
        </div>
        <div class="col-sm-7 align-self-sm-center">
            <div class="bc-title"><?php echo $title; ?></div>
            <span class="bc-firstname"><?php echo $firstname; ?></span>
            <span class="bc-lastname"><?php echo $lastname; ?></span>
            <div class="bc-company"><?php echo $company; ?></div>
        </div>
        <div class="col-0-5 align-self-sm-end designer-line"></div>
    </div>
    <div class="business-card-back bc-back row">
        <div class="col-sm-6">
            <div class="bc-title"><?php echo $title ?></div>
            <span class="bc-firstname"><?php echo $firstname; ?></span>
            <span class="bc-lastname"><?php echo $lastname; ?></span>
        </div>
        <div class="col-sm-6 contacts">
            <div><i class="fas fa-map-marker"></i>&nbsp;<?php echo $address; ?></div>
            <div><i class="fas fa-phone"></i>&nbsp;<?php echo $phone; ?></div>
            <div><i class="fas fa-envelope"></i>&nbsp;<?php echo $email; ?></div>
            <div><i class="fab fa-github"></i>&nbsp;<?php echo $website; ?></div>
            <div><?php echo $available ? 'Available for contracts' : 'Unavailable for contracts'; ?></div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- Bootstrap logical library reference -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>
</html>
