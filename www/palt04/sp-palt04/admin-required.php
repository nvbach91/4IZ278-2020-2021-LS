<?php

    // role: normal user = 0,admin = 1
    if (!$_SESSION['admin']) {
        header('Location: not-authorized.php');
        exit();
    }
?>