<?php
    require __DIR__ . '/config/config.php';

    $stmt = $connect->prepare('SELECT privilege FROM users WHERE user_id = :user_id LIMIT 1');
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $user_privilege = (int) $stmt->fetchColumn();

    // role: normal user = 0,admin = 1
    if ($user_privilege < 1) {
        header('Location: not-authorized.php');
        exit();
    }
?>