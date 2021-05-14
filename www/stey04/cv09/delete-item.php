<?php

require __DIR__ . '/config.php';

$sql = "DELETE FROM " . $tableName . " WHERE id = :id";
//$sql = "DELETE FROM goods WHERE id = :id";
$statement = $pdo->prepare($sql);
//$statement->bind('id', $_GET['id']);
$statement->execute(['id' => $_GET['id']]);

var_dump($statement);
header('Location: index.php');
