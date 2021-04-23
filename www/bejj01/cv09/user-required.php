<?php
    require __DIR__ . '/db.php';

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit('User must be logged in to enter this site.');
    }

    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $current_user = $stmt->fetchAll()[0];

    if (!$current_user) {
        session_destroy();
        header('Location: index.php');
        exit();
    }

?>