<?php require __DIR__ . '/config.php'; ?>
<?php

$nItems = 4;
$offset = @$_GET['offset'] ? (int)$_GET['offset'] : 0;

$numberOfGoods = $pdo->query("SELECT COUNT(id) FROM goods;")->fetchColumn();


$sql = "SELECT * FROM goods WHERE 1 LIMIT $nItems OFFSET ?;";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $offset, PDO::PARAM_INT);
$statement->execute();
$goods = $statement->fetchAll(PDO::FETCH_ASSOC);

$numberOfPaginations = ceil($numberOfGoods / $nItems);


/*
$sql = 'SELECT * FROM ' . $tableName;
$statement = $pdo->prepare($sql);
$statement->execute();
$goods = $statement->fetchAll();

$count = $pdo->query("SELECT COUNT(id) FROM goods")->fetchColumn();
*/

?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/nav.php' ?>
<main>
    <div>Number of goods: <?php echo $numberOfGoods; ?></div>
    <div>Number of pagination: <?php echo $numberOfPaginations; ?></div>

    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
            <li class="page-item <?php echo $offset / $nItems + 1 == $i ? 'active ' : ''; ?>">
                <a class="page-link" href="index.php?offset=<?php echo $nItems * ($i - 1); ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php } ?>
    </ul>

    <div class="goods">
        <?php foreach ($goods as $good) : ?>
            <div class="card good" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo $good['img']; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $good['name']; ?></h5>
                    <h6 ><?php echo $good['price'] . ' ' . CURRENCY; ?></h5>
                    <p class="card-text"><?php echo $good['description']; ?></p>
                    <a href="buy.php?id=<?php echo $good['id']; ?>" class="btn btn-primary">Buy</a>
                    <a href="edit-item.php?id=<?php echo $good['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="delete-item.php?id=<?php echo $good['id']; ?>" class="btn btn-primary">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
            <li class="page-item <?php echo $offset / $nItems + 1 == $i ? 'active ' : ''; ?>">
                <a class="page-link" href="index.php?offset=<?php echo $nItems * ($i - 1); ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php } ?>
    </ul>

</main>
<?php include __DIR__ . '/includes/footer.php' ?>
