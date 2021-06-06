<?php

require __DIR__ . '/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit('User must be logged in to enter this site.');
}

$statement = $pdo->prepare('SELECT * FROM user WHERE user_id = :user_id');
$statement->execute(['user_id' => $_SESSION['user_id']]);
$current_user = $statement->fetchAll()[0];

if (!$current_user) {
    session_destroy();
    header('Location: index.php');
    exit();
}

?>