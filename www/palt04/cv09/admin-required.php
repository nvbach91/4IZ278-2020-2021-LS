<?php
    require __DIR__ . '/config/config.php';
    require __DIR__ . '/user-required.php';

    $stmt = $connect->prepare('SELECT privilege FROM users WHERE user_id = :user_id LIMIT 1');
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $user_privilege = (int) $stmt->fetchColumn();

    // role: normal user = 0, manager = 1, admin = 2,
    if ($user_privilege < 2) {
        header('Location: not-authorized.php');
        exit();
    }
?>