<?php
include "database_connection.php";
$id=$_POST['id'];
$update = "UPDATE borrowing SET status=3 WHERE id=$id";
$statement = $pdo->prepare($update);
$statement->execute();

$sqlid = "SELECT id_product FROM borrowing where id = $id ";
$statid = $pdo->prepare($sqlid);
$statid->execute();
$resultid = $statid->fetchAll();

$result_id = $resultid[0]['id_product'];

$stateupt = "UPDATE product SET id_state=1 WHERE id=$result_id";
$statupt = $pdo->prepare($stateupt);
$statupt->execute();

?>