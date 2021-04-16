<?php require __DIR__ . '/db.php' ?>
<?php 
    session_start();


    if(count($_SESSION['cart']) >= 1){
        $sqlAll= "SELECT * FROM goods WHERE id IN (" . implode(",",$_SESSION['cart']) .") ORDER BY name ";
        $statement = $pdo->prepare($sqlAll);
        $statement->execute();
        $goods = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $goods = [];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
</head>
<body>
    <h2>Your cart</h2>
    <div>
        <?php foreach($goods as $good): ?>
            <div class="cart-good"><?php echo $good['name']?></div>
            <div class="cart-remove"><a href="remove-item.php?id=<?php echo $good['id']?>">Remove from cart</a></div>
        <?php endforeach; ?>
        <a href="index.php">Go back</a>
    </div>
</body>
</html>