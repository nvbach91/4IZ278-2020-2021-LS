<?php require_once __DIR__ . '/class/UsersDB.php'; ?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

$usersDB = new UsersDB();




$current_user = $usersDB->fetchUserById($_SESSION['user_id']);

if (!$current_user) {
    session_destroy();
    header('Location: index.php');
    exit();
}
