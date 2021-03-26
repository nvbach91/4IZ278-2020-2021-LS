
<?php require __DIR__ . '/database_connection.php' ?>
<?php

$id = @$_GET['id'];

$sqlDelete = "DELETE FROM products WHERE product_id = :id;";
$statement = $pdo->prepare($sqlDelete);
$statement->execute(['id' => $id]);

?>