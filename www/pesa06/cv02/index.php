<?php require 'Factory/PersonFactory.php';?>
<?php
$personFactory = new PersonFactory();
$people = [
        $personFactory->createPersonOne(),
        $personFactory->createPersonTwo(),
    ];


?>

<?php include 'header.html';?>
<?php include 'content.php';?>
<?php include 'scripts.html';?>