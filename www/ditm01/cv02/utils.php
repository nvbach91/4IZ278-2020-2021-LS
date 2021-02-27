<?php
function calculateAge($datebirth) {
    $today = new DateTime();
    $born = new DateTime($datebirth);
    $age = $today->diff($born);
    return $age->y;
};

?>