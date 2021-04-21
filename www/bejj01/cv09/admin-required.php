<?php
    require __DIR__ . '/db.php';
    require __DIR__ . '/user-required.php';

    $stmt = $pdo->prepare('SELECT role FROM users WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user_role = (int) $stmt->fetchColumn();

    // role: normal user = 0, manager = 1, admin = 2,
    if ($user_role < 2) {
        header('Location: not-authorized.php');
        exit();
    }
?>