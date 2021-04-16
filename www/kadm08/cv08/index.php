<?php
require __DIR__ . '/db.php';


if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}
$nItemsPerPagination = 3;


$nItemsInDatabase = $pdo->query("SELECT COUNT(id) FROM goods;")->fetchColumn();
$nPaginations = ceil($nItemsInDatabase / $nItemsPerPagination);

$sql = "SELECT * FROM goods WHERE 1 limit $nItemsPerPagination OFFSET :offset;";

$stmt = $pdo->prepare("SELECT * FROM goods ORDER BY id DESC LIMIT $nItemsPerPagination OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$goods = $stmt->fetchAll();

?>

<?php require __DIR__ . '/includes/header.php'; ?>

<main class="container">
    <div> Total items: <?php echo $nItemsInDatabase; ?> </div>
    <div> Items per page: <?php echo $nItemsPerPagination; ?> </div>
    <?php if (isset($_COOKIE['email'])) : ?>
        <br><br>
        <a class="btn btn-primary" href="create-item.php">Add new item</a>
        <br><br>
    <?php endif; ?>
    <div class="paginations">
        <?php for ($i = 1; $i <= $nPaginations; $i++) { ?>
            <a class="pagination<?php $offset / $nItemsPerPagination + 1 == $i ? 'active' : ''; ?>" href="./index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
    <div class="row">
        <?php foreach ($goods as $good) : ?>
            <div class="card product" style="width: calc(100% / 3)">
                <div class="card-body">
                    <img class="card-img-top product-image" src="<?php echo $good['img']; ?>" alt="mango-product-image"> </a>
                    <h4 class="card-title"><?php echo $good['name']; ?></a></h4>
                    <h5><?php echo number_format($good['price'], 2), ' ', 'Kč'; ?></h5>
                    <p class="card-text"> <?php echo $good['description'] ?>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
                <div class="controls">
                    <?php if (isset($_COOKIE['email'])) : ?>
                        <a class="btn btn-secondary card-link" href='buy.php?id=<?php echo $good['id'] ?>'>Buy</a>
                        <a class="btn btn-secondary card-link" href='edit-item.php?id=<?php echo $good['id'] ?>'>Edit</a>
                        <a class="btn btn-secondary card-link" href='delete-item.php?id=<?php echo $good['id'] ?>'>Delete</a>
                    <?php else : ?>
                        <a class="btn btn-secondary card-link" href='buy.php?id=<?php echo $good['id'] ?>'>Buy</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
</main>