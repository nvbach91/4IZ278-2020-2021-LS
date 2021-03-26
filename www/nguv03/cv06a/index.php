<?php require __DIR__ . '/database_connection.php' ?>
<?php
    $sql = "SELECT * FROM products";

    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();

    // print_r($results);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?php foreach($results as $result): ?>
            <div>Product name: <?php echo $result['name']; ?></div>
            <div>Price: <?php echo $result['price']; ?> <?php echo CURRENCY; ?></div>
            <img width="200" alt="<?php echo $result['name']; ?>" src="<?php echo $result['img']; ?>">
        <?php endforeach; ?>
    </div>
</body>
</html>
