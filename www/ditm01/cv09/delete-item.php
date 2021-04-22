<?php require __DIR__ . '/database_connection.php';?>
<?php require __DIR__ . '/user_required.php';?>
<?php require __DIR__ . '/admin_required.php';?>
<?php
$sql = "DELETE FROM " . $tableName . " WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->execute(['id' => $_GET['id']]);

var_dump($statement);
header('Location: index.php');
?>