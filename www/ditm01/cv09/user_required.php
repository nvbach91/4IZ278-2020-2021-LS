<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

$sql = 'SELECT * FROM users WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->execute([
    'id' => $_SESSION['user_id']
]);

$current_user = $statement->fetchAll()[0];

if (!$current_user) {
    session_destroy();
    header('Location: index.php');
    exit();
}