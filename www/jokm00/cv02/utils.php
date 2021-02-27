<?php

function calculateAge($birthDate){
    $bday = new DateTime($birthDate);

    return $bday->diff(new DateTime("now"))->y;
}
?>