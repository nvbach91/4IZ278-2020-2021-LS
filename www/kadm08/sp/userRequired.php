<?php

require_once __DIR__ . '/lib/UserDB.php';

$userDB = new UserDB();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit('User must be logged in to enter this site.');
}

$current_user = $userDB->fetchUser($_SESSION['user_id']);

if (!$current_user) {
    session_destroy();
    header('Location: index.php');
    exit();
}

?>