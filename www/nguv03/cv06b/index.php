<?php require __DIR__ . '/database_connection.php'; ?>
<?php 



    $sql = "SELECT * FROM products WHERE 1;";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>PDO connection</h1>
    <div class="products">
        <?php foreach($results as $result): ?>
            <div class="product">
                <div class="product-name"><?php echo $result['name']; ?></div>
                <div class="product-price"><?php echo $result['price'] . ' ' . CURRENCY; ?></div>
                <a href="search.php?id=<?php echo $result['product_id']; ?>">Show this product</a>
                <img width="200" class="product-image" src="<?php echo $result['img']; ?>" alt="<?php echo $result['name']; ?>">
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>