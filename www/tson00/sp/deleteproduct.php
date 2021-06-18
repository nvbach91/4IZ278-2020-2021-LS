<?php
include "database_connection.php";
$id=$_POST['id'];
    $sql = "DELETE FROM product WHERE id = $id";
    $statement = $pdo->prepare($sql);
    $statement->execute();


  
    $sqlbor = "DELETE FROM borrowing WHERE id_product = $id";
    $stat = $pdo->prepare($sqlbor);
    $stat->execute();

?>