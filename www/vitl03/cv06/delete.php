<?php 
    require __DIR__ . '/database_connection.php';
?>
<?php

    $id = @$_GET['id'];

    $sql1 = "DELETE FROM products WHERE product_id=:id;";
    $statement1 = $pdo->prepare($sql1);
    $statement1->execute([
        'id'=>$id,
    ]);

    header('Location: index.php');


?>
