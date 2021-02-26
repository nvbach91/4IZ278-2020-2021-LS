<?php
// Funkce pro pocitani veku z data narozeni
function deductAge($dateOfBirth)
{
    $age = time()-$dateOfBirth;
    return $age / 365;
}
?>