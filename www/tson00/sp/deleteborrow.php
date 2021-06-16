<?php
include "database_connection.php";
$id=$_POST['id'];
$update = "UPDATE borrowing SET status=4 WHERE id=$id";
$statement = $pdo->prepare($update);
$statement->execute();

$results = $statement->fetchAll();

  

?>