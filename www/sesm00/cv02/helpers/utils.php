<?php

function calculateAge($birthDate) {
    $now = new DateTime();
    $born = new DateTime($birthDate);
    $age = $now->diff($born);
    return $age->y;
}