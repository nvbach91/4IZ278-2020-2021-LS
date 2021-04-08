<?php require __DIR__ . '/database_connection.php'; ?>
<?php 

    $id = @$_GET['id'];

    $sql = "DELETE FROM products WHERE product_id = :id;";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'id' => $id,
    ]);

    header('Location: index.php');

?>