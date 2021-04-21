<?php
    require('./config/config.php');
    require('./user-required.php');

    $stmt = $connect->prepare('SELECT privilege FROM users WHERE user_id = :user_id LIMIT 1');
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $user_privilige = (int) $stmt->fetchColumn();

    // role: normal user = 0, manager = 1, admin = 2,
    if ($user_privilige < 1) {
        header('Location: not-authorized.php');
        exit();
    }
?>