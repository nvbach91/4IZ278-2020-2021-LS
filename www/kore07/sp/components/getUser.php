<?php require_once __DIR__ . '/../database/UsersDB.php'; ?>
<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $usersDB = new UsersDB();

    if (isset($_SESSION['user_email'])) {
        $existing_user = $usersDB->fetchBy('user_email', $_SESSION['user_email']);
    }
?>