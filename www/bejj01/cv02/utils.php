<?php

function createShortNumber($number) {
    $shortNumber = $number / 1000000;
    return $shortNumber . ' mil.';
}

function createWholeAddress($street, $propertyNumber, $orientationNumber, $city) {
    return "$street $propertyNumber/$orientationNumber, $city";
}

function calculateAge($birthDate) {
    return $birthDate->diff(new DateTime('now'))->y;
}

?>