<?php
function getAge($dateOfBirth)
{
    $timeNow = date('m.d.Y');
    $diff = abs(strtotime($timeNow) - strtotime($dateOfBirth));
    $years = floor($diff / (365 * 60 * 60 * 24));

    return "Věk: $years let ";
}
