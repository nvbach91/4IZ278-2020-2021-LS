<?php require 'Factory/PersonFactory.php';?>
<?php
$personFactory = new PersonFactory();
$people = [
        $personFactory->createPersonOne(),
        $personFactory->createPersonTwo(),
    ];


?>

<?php include 'header.html';?>
<?php include 'scripts.html';?>
<?php include 'content.php';?>
