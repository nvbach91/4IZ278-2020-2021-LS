<?php
include "partials/header.php";
include "partials/Person.php";
include "partials/functions.php";
include "partials/register.php";
?>

<h1 class="text-center">My Business Card in PHP OOP Style</h1>

<?php foreach ($people as $person) : ?>

    <div class="business-card front">
        <div class="logo" style="background-image: url(img/<?= str_replace(str_split(" ,"), '', $person->get_company()) ?>-logo.png)"></div>
        <div class="info">
            <div class="firstname"><?= $person->get_firstname() ?></div>
            <div class="lastname"><?= $person->get_lastname() ?></div>
            <div class="age">Age <?= calc_age($person) ?></div>
            <div class="title"><?= $person->get_title() ?></div>
            <div class="company"><?= str_replace(' ', '&nbsp;', $person->get_company()) ?></div>
        </div>
    </div>
    <div class="business-card back">
        <div class="me">
            <div class="firstname"><?= $person->get_firstname() ?></div>
            <div class="lastname"><?= $person->get_lastname() ?></div>
            <div class="title"><?= $person->get_title() ?></div>
        </div>
        <div class="contacts">
            <div class="address"><i class="fas fa-map-marker-alt"></i> <?= getAddress($person) ?></div>
            <div class="phone"><i class="fas fa-phone"></i> <?= $person->get_phone() ?></div>
            <div class="email"><i class="fas fa-at"></i> <?= $person->get_email() ?></div>
            <div class="website"><i class="fas fa-globe"></i> <?= $person->get_website() ?></div>
            <div class="available"><?= $person->get_available() ?></div>
        </div>
    </div>

<?php endforeach; ?>

<?php include "partials/footer.php"; ?>