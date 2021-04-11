<?php include "partials/header.php"; ?>

<?php 
  $firstname = "Joe";
  $lastname = "Mama";

  $birthDate = "12/17/1983";
  $birthDate = explode("/", $birthDate);
  $age = "Age: ";
  $age .= (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
  
  $title = "Plumber";
  $company = "Plumber & Son a.s.";
  $address = "Your house 66, Prague, 841 01";
  $phone = "+421 234 567 890";
  $email = "mama@gmail.com";
  $website = "www.joe-mama.com";
  $available = "Searching for pipes to fix";
?>

<h1 class="text-center">My Business Card in PHP</h1>
        <div class="business-card front">
            <div class="logo" style="background-image: url(img/plumber-logo.png)"></div>
            <div class="info">
                <div class="firstname"><?= $firstname ?></div>
                <div class="lastname"><?= $lastname ?></div>
                <div class="age"><?= $age ?></div>
                <div class="title"><?= $title ?></div>
                <div class="company"><?= $company ?></div>
            </div>
        </div>
        <div class="business-card back">
            <div class="me">
                <div class="firstname"><?= $firstname ?></div>
                <div class="lastname"><?= $lastname ?></div>
                <div class="title"><?= $title ?></div>
            </div>
            <div class="contacts">
                <div class="address"><i class="fas fa-map-marker-alt"></i> <?= $address ?></div>
                <div class="phone"><i class="fas fa-phone"></i> <?= $phone ?></div>
                <div class="email"><i class="fas fa-at"></i> <?= $email ?></div>
                <div class="website"><i class="fas fa-globe"></i> <?= $website ?></div>
                <div class="available"><?= $available ?></div>
            </div>
        </div>
  
  <?php include "partials/footer.php"; ?>