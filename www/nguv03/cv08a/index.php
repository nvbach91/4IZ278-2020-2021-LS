<?php require __DIR__ . '/db.php' ?>
<?php


if (!empty($_GET)) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

$numberOfItemsPerPagination = 4;
$numberOfGoods = $pdo->query("SELECT COUNT(id) FROM goods;")->fetchColumn();


$sql = "SELECT * FROM goods WHERE 1 LIMIT $numberOfItemsPerPagination OFFSET ?;";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $offset, PDO::PARAM_INT);
$statement->execute();

$goods = $statement->fetchAll(PDO::FETCH_ASSOC);


$numberOfPaginations = ceil($numberOfGoods / $numberOfItemsPerPagination);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .goods {
            display: flex;
            flex-wrap: wrap;
        }
        .good {
            width: 25%;
        }
        .image {
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            height: 100px;
        }
        .pagination {
            padding: 5px;
            background-color: aquamarine;
            margin-left: 5px;
            color: white;
        }
        .pagination.active {
            background-color: firebrick;
        }

    </style>
</head>
<body>
    <nav>
        <?php if (@$_COOKIE['username']): ?>
            <a href="logout.php">Logout <?php echo $_COOKIE['username']; ?></a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
        
    </nav>
    <div>Number of goods: <?php echo $numberOfGoods; ?></div>
    <div>Number of pagination: <?php echo $numberOfPaginations; ?></div>
    <div class="paginations">
        <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
            <a class="pagination<?php echo $offset / $numberOfItemsPerPagination + 1 == $i ? ' active' : ''; ?>" href="index.php?offset=<?php echo $numberOfItemsPerPagination * ($i - 1); ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
    
    <div class="goods">
        <?php foreach($goods as $good): ?>
            <div class="good">
                <div class="image" style="background-image: url(<?php echo $good['img']; ?>)"></div>
                <div class="name"><?php echo $good['name']; ?></div>
                <div class="price"><?php echo $good['price']; ?></div>
                <div class="description"><?php echo $good['description']; ?></div>
                <div class="controls">
                    <a href="buy.php?id=<?php echo $good['id']; ?>&offset=<?php echo $offset; ?>">Buy id=<?php echo $good['id']; ?></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="paginations">
        <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
            <a class="pagination<?php echo $offset / $numberOfItemsPerPagination + 1 == $i ? ' active' : ''; ?>" href="index.php?offset=<?php echo $numberOfItemsPerPagination * ($i - 1); ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
</body>
</html>

