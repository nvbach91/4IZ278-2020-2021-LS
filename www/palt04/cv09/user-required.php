<?php
require("./config/config.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

//v session je user id uzivatele, ted ho nacteme z db
$stmt = $connect->prepare('SELECT * FROM users WHERE user_id = :user_id LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
$stmt->execute([
    'user_id' => $_SESSION['user_id']
]);

//nacte do promenne $user aktualne prihlaseneho usera, bude pristupny z cele aplikace
$current_user = $stmt->fetchAll()[0]; //vezmi prvni zaznam z db

//pokud by v db z nejakeho duvodu user nebyl (treba byl mezitim nejak smazan), tak vymaz session a jdi na prihlaseni
if (!$current_user) {
    session_destroy();
    header('Location: login.php');
    exit();
}