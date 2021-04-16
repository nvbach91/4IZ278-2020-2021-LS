<?php require __DIR__ . '/db.php'; ?>
<?php 
    session_start();
    if (count($_SESSION['cart']) >= 1) {
        // [1,2,3,4,5] -> "1,2,3,4,5"
        // implode(',', [1,2,3,4,5])
        $sql = "SELECT * FROM goods WHERE id IN (" . implode(',', $_SESSION['cart']) . ") ORDER BY name;";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $goods = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $goods = [];
    }
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
    <div>
        <?php foreach($goods as $good): ?>
            <div class="good">
                <div class="good-name">
                    <?php echo $good['name'] . ' (id=' . $good['id'] . ')'; ?>
                </div>
                <div class="good-delete">
                    <a href="remove-item.php?id=<?php echo $good['id']; ?>">
                        Remove from cart
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div>
        <a href="index.php?offset=<?php echo @$_SESSION['offset']; ?>">Back to shop</a>
    </div>
</body>
</html>