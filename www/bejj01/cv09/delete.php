<?php
    require __DIR__ . '/manager-required.php';
    require __DIR__ . '/db.php';

    $offset = @$_GET['offset'];
    $sql = "DELETE FROM goods WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute(['id' => @$_GET['id']]);
    if (!$result){
        exit("Something went wrong. Cannot delete!");
    }

    header("Location: index.php?offset=$offset");
    exit();
?>