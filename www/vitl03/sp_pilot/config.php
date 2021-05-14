<?php


$pdo = new PDO(
    'mysql:host=localhost;dbname=vitl03;charset=utf8mb4',
    'vitl03', 
    'eigheeLae4Aith9aiH'
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


?>
