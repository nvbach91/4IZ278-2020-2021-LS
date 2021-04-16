<?php require __DIR__ . '/db.php' ?>
<?php 
    session_start();
    if (count($_SESSION['cart']) >= 1) {
        $sql = "SELECT * FROM goods WHERE id IN (" . implode(",", $_SESSION['cart']) . ") ORDER BY name";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $goods = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $goods = [];
    }
    // var_dump($goods);
    // $ids = @$_SESSION['cart'];


    // if (!empty($_GET)) {

    //     // check login data!

    //     $id = $_GET['id'];
    //     array_push($ids, $id);
    //     header('Location: index.php');
    // }

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
    <h2>Your cart</h2>
    <div>
        <a href="index.php?offset=<?php echo isset($_SESSION['offset']) ? $_SESSION['offset'] : '0'; ?>">Back to shopping</a>
    </div>
    <div>
        <?php foreach($goods as $good): ?>
            <div class="cart-good">
                <div class="cart-good"><?php echo $good['name'] . ' id=' . $good['id']; ?></div>
                <div class="cart-remove">
                    <a href="remove-item.php?id=<?php echo $good['id']; ?>">Remove from cart</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <a href="checkout.php">Go to checkout</a>
</body>
</html>