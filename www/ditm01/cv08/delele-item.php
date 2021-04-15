<?php require __DIR__ . '/database_connection.php';

$sql = "DELETE FROM " . $tableName . " WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->execute(['id' => $_GET['id']]);

var_dump($statement);
header('Location: index.php');