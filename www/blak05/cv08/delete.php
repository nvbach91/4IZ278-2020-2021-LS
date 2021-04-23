<?php require __DIR__ . '/db.php' ?>
<?php

    $id = $_GET['id'];
    $sql= "DELETE FROM goods WHERE id = $id ";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    header("Location: index.php");

?>