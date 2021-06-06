<?php

require __DIR__ . '/db.php';

if ($_SESSION['type'] != 1) {
    header('Location: index.php');
    exit('You must be an admin to enter this site.');
}

?>