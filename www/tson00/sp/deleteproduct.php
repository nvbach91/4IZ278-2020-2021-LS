<?php
include "database_connection.php";
$id=$_POST['id'];
    $sql = "DELETE FROM product WHERE id = $id";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();

  

?>