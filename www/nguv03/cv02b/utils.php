<?php


function shortenNumberByMilion($number) {
    $shortNumber = $number / 1000000;
    return "$shortNumber M";
}


?>