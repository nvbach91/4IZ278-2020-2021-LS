<?php
    require __DIR__ . '/user-required.php';

    session_destroy();
    header('Location: index.php');

?>