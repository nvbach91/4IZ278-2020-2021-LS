<?php 

// if (!@$_COOKIE['username']) {
//     header('Location: login.php');
//     exit();
// }

$offset = 0;

if(!empty($_GET)) {
    $offset = $_GET['offset'];
} 

$nItemsPerPagination = 4;

$pdo = new PDO(
    "mysql:host=localhost;dbname=test;charset=utf8mb4",
    "root",
    ""
);

$nItemsInDatabase = $pdo->query("SELECT COUNT(id) FROM goods;")->fetchColumn();
$nPaginations = ceil($nItemsInDatabase / $nItemsPerPagination);

$sql = "SELECT * FROM goods WHERE 1 LIMIT $nItemsPerPagination OFFSET ?;";

// 0; DROP TABLE goods; --
// "SELECT * FROM goods WHERE price < $maxPrice;qweqweqw"
// "SELECT * FROM goods WHERE price <  0; DROP TABLE goods; --;qweqweqw"

$statement = $pdo->prepare($sql);
$statement->bindValue(1, $offset, PDO::PARAM_INT);
$statement->execute();

$goods = $statement->fetchAll(PDO::FETCH_ASSOC);

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
        .img {
            height: 100px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .price {
            font-size: 32px;
        }
        .name {
            font-weight: bold;
        }
        .pagination {
            background-color: cadetblue;
            padding: 10px;
            margin-right: 5px;
            color: white;
        }
        .paginations {
            margin: 10px 0;
        }
        .pagination.active {
            background-color: firebrick;
        }
    </style>
</head>
<body>
    <nav>
        <?php if (@$_COOKIE['username']): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Go to login</a>
        <?php endif; ?>
    </nav>
    <h1>Fruit eshop</h1>
    <div>Number of items in catalog: <?php echo $nItemsInDatabase; ?></div>
    <div>Number of pagination: <?php echo $nPaginations; ?></div>
    <div class="paginations">
        <?php for ($i = 1; $i <= $nPaginations; $i++) { ?>
            <a class="pagination<?php echo ($offset / $nItemsPerPagination) + 1 == $i ? ' active' : ''; ?>" href="index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
    <div class="goods">
        <?php foreach($goods as $good): ?>
            <div class="good">
                <div class="img" style="background-image: url(<?php echo $good['img']; ?>)"></div>
                <div class="name"><?php echo $good['name'] . ' id=' . $good['id']; ?></div>
                <div class="price"><?php echo $good['price']; ?></div>
                <div class="description"><?php echo $good['description']; ?></div>
                <div class="controls">
                    <a href="buy.php?id=<?php echo $good['id']; ?>">Buy id=<?php echo $good['id']; ?></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="paginations">
        <?php for ($i = 1; $i <= $nPaginations; $i++) { ?>
            <a class="pagination<?php echo ($offset / $nItemsPerPagination) + 1 == $i ? ' active' : ''; ?>" href="index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
</body>
</html>