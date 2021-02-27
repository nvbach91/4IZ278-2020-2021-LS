<?php

$name = 'Petr Klepetko';
$street = 'Nademlejnska';
$number = '20';
$city = 'Praha';
$phone = '602149444';
$mail = 'klepetkope@gmail.com';

$address = "$street, $number, $city"; //TODO

$birthDay = 19;
$birthMonth = 11;
$birthYear = 1998;
$company = 'Dáváme s. r. o.';
$web = 'eso.vse.cz/~klep03/cv01/';
$isAvailable = 'Jsem dostupný';

$logoPath = 'logo.png';






//GONE $birthDate = "$birthDay. $birthMonth. $birthYear";
//GONE $countedAge = 2021 - $birthYear; 



?>

<?php require './includes/person.php' ?>

<?php include './includes/declarePersons.php' ?>

<?php require './includes/header.php' ?>   
<?php include './includes/displayCards.php' ?>
<?php require './includes/footer.php' ?>

<?php require './includes/hotreloader.php'; ?>