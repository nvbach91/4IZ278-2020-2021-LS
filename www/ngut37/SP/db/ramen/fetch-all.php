<?php 

    $sql = "SELECT * FROM ramen";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();

?>