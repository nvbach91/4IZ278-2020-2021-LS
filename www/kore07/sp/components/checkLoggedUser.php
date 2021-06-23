<?php require_once __DIR__ . '/getUser.php'; ?>
<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header('Location: signin.php');
        exit();
    }

    if (!$existing_user) {
        session_destroy();
        header('Location: index.php');
        exit();
    }

?>
