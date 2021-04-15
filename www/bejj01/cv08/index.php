<?php

require __DIR__ . '/includes/header.php';
require __DIR__ . '/db.php';

if (!empty($_GET)) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

$numberOfItemsPerPagination = 4;
$currentItemSelected = $offset / $numberOfItemsPerPagination;
$numberOfGoods = $pdo->query("SELECT COUNT(id) FROM goods")->fetchColumn();

$sql = "SELECT * FROM goods WHERE 1 LIMIT $numberOfItemsPerPagination OFFSET ?;";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $offset, PDO::PARAM_INT);
$statement->execute();

$goods = $statement->fetchAll(PDO::FETCH_ASSOC);
$numberOfPaginations = ceil($numberOfGoods / $numberOfItemsPerPagination);

// pagination arrows index handling
$previousItem = $currentItemSelected - 1;
$nextItem = $currentItemSelected + 1;
if ($currentItemSelected == 0) {
    $previousItem = $numberOfPaginations - 1;
} else if ($currentItemSelected == $numberOfPaginations - 1) {
    $nextItem = 0;
}

?>

<!-- Page Content -->
<main class="container">
    <h1 class="my-4 text-center">Mango Shop</h1>

    <div class="row labels">
        <div class="goods-number">Available Mangos: <?php echo $numberOfGoods; ?></div>
        <a class="new-button text-left btn btn-primary" href="create.php?offset=<?php echo $offset; ?>">Add new mango</a>
    </div>
    
    <div class="paginations row mb-4">
        <div class="pagination-container arrow mr-2">
            <a class="pagination" href="index.php?offset=<?php echo $numberOfItemsPerPagination * $previousItem; ?>">
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>
        <?php for ($i = 1; $i <= $numberOfPaginations; $i++) : ?>
            <div class="pagination-container mr-2 <?php echo $offset / $numberOfItemsPerPagination + 1 == $i ? 'active' : '' ?>">
                <a class="pagination" href="index.php?offset=<?php echo $numberOfItemsPerPagination * ($i - 1); ?>">
                    <?php echo $i; ?>
                </a>
                <div class="active-indicator"></div>
            </div>
        <?php endfor; ?>
        <div class="pagination-container arrow mr-2">
            <a class="pagination" href="index.php?offset=<?php echo $numberOfItemsPerPagination * $nextItem; ?>">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

    <div class="goods row">
        <?php foreach ($goods as $good) : ?>
            <div class="col-lg-4 col-md-5 mb-4">
                <div class="card text-muted">
                    <div class="image-container">
                        <img class="card-img-top" src="<?php echo $good['img']; ?>" alt="<?php echo $good['name']; ?>">
                    </div>
                    <div class="card-body bg-light">
                        <h4 class="card-title text-center text-primary">
                            <?php echo $good['name']; ?>
                        </h4>
                        <hr class="bg-primary">
                        <h5 class="text-dark"><?php echo number_format($good['price'], 2, ',', ' '), ' CZK'; ?></h5>
                        <p class="text-dark"><?php echo $good['description']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-dark" href="buy.php?id=<?php echo $good['id']; ?>">Buy</a>
                        <a class="btn btn-secondary" href="edit.php?id=<?php echo $good['id']; ?>&offset=<?php echo $offset ?>">Edit</a>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $good['id']; ?>&offset=<?php echo $offset ?>">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="paginations row mb-4">
        <div class="pagination-container arrow mr-2">
            <a class="pagination" href="index.php?offset=<?php echo $numberOfItemsPerPagination * $previousItem; ?>">
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>
        <?php for ($i = 1; $i <= $numberOfPaginations; $i++) : ?>
            <div class="pagination-container mr-2 <?php echo $offset / $numberOfItemsPerPagination + 1 == $i ? 'active' : '' ?>">
                <a class="pagination" href="index.php?offset=<?php echo $numberOfItemsPerPagination * ($i - 1); ?>">
                    <?php echo $i; ?>
                </a>
                <div class="active-indicator"></div>
            </div>
        <?php endfor; ?>
        <div class="pagination-container arrow mr-2">
            <a class="pagination" href="index.php?offset=<?php echo $numberOfItemsPerPagination * $nextItem; ?>">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
</main>
<!-- /.container -->

<?php require __DIR__ . '/includes/footer.php' ?>