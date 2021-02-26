<?php

function computeAgeFromDateOfBirth(DateTime $dateOfBirth) {
    // Return difference in years...
    return $dateOfBirth->diff(new DateTime())->y;
}
