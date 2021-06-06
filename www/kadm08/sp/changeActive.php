<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/lib/adminRequired.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workplace = $pdo->prepare("SELECT * FROM workplace WHERE ws_id = :ws_id;");
    $workplace->execute([
        'ws_id' => $_GET['ws_id']
    ]);
    $workplace = $workplace->fetchAll()[0];

    if ($workplace['active'] == 0) {
        $statement = $pdo->prepare("UPDATE workplace SET active = 1
                            WHERE ws_id = :ws_id;");
        $statement->execute(['ws_id' => $_GET['ws_id']]);
    } else {
        $statement = $pdo->prepare("UPDATE workplace SET active = 0
                                WHERE ws_id = :ws_id;");
        $statement->execute(['ws_id' => $_GET['ws_id']]);
    }

    header('Location: workplaces.php');
}
