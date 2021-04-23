<?php

session_start();

$pdo = new PDO(
    "mysql:host=localhost;dbname=vitl03;charset=utf8mb4",
    "vitl03",
    "eigheeLae4Aith9aiH"
);
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}


$statement = $pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1'); 
$statement->execute([
    'id' => $_SESSION['user_id']
]);



$current_user = $statement->fetchAll()[0]; 

if (!$current_user) {
    session_destroy();
    header('Location: index.php');
    exit();
}