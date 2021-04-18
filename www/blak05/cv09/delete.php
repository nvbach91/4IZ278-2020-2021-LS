<?php require __DIR__ . '/db.php' ?>
<?php require __DIR__ . '/auth.php' ?>
<?php
    if (@$_COOKIE['priviledge'] == 2){
    $id = $_GET['id'];
    $sql= "DELETE FROM goods WHERE id = $id ";
    $statement = $pdo->prepare($sql);
    $statement->execute();
}

$pageOffset = @$_COOKIE['offset'];
header("Location: index.php?offset=$pageOffset");

?>