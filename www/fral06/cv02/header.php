<?php
require './Person.php';

$me = new Person(
    'Lukáš',
    'Frajt',
    '31.07.1997',
    '123 456 789',
    'email@sap.com',
    false,
    'Accessibility developer',
    'logo.svg',
    'SAP Concur',
    'Praha',
    'Bucharova',
    '2817',
    '11',
    'https://www.concursolutions.com'
);

$person1 = new Person(
    'Jan',
    'Zahradníček',
    '31.07.1992',
    '721 537 789',
    'jan-zahradnicek@sap.com',
    false,
    'Technical Consultant',
    'logo.svg',
    'SAP Concur',
    'Praha',
    'Bucharova',
    '2817',
    '11',
    'https://www.concursolutions.com'
);

$person2 = new Person(
    'Karel',
    'Omáčka',
    '31.07.1978',
    '092 456 492',
    'karel-omacka@sap.com',
    false,
    'HR manager',
    'logo.svg',
    'SAP Concur',
    'Praha',
    'Bucharova',
    '2817',
    '11',
    'https://www.concursolutions.com'
);
$people = array();
array_push($people, $me, $person1, $person2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
