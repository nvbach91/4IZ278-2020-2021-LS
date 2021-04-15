<?php

if (!empty($_GET)) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

$pdo = new PDO(
    "mysql:host=localhost;dbname=testBach;charset=utf8mb4",
    "root",
    ""
);
$numberOfItemsPerPagination = 4;
$numberOfGoods = $pdo->query("SELECT COUNT(id) FROM goods;")->fetchColumn();


$sql = "SELECT * FROM goods WHERE 1 LIMIT $numberOfItemsPerPagination OFFSET ?;";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $offset, PDO::PARAM_INT);
$statement->execute();

$goods = $statement->fetchAll(PDO::FETCH_ASSOC);

$numberOfPaginations = ceil($numberOfGoods / $numberOfItemsPerPagination);
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">YourMango.com</a>    
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Košík</a>
                    </li>
                    <li class="nav-item">
                    <?php if (@$_COOKIE['username']): ?>
                        <a class="nav-link" href="profil.php"><?php echo $_COOKIE['username']; ?></a>
                        <?php else: ?>
                        <a class="nav-link" href="profil.php">Profil</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if (@$_COOKIE['username']): ?>
                        <a class="nav-link" href="logout.php">Logout</a>
                        <?php else: ?>
                        <a class="nav-link" href="login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <h1>Vítejte na eshopu s mangy!</h1>
        Total mango count: <?php echo $numberOfGoods ?> <br>
        Total number of pages: <?php echo $numberOfPaginations ?>
        <div class="goods">
            <?php foreach($goods as $good): ?>
            <!--
                <div class="good">
                    <div class="image" style="background-image: url(<?php echo $good['img']; ?>)"></div>
                    <div class="controls">
                        <a href="buy.php?id=<?php echo $good['id']; ?>">Buy id=<?php echo $good['id']; ?></a>
                    </div>
                </div>
                -->
                <div class="card" style="width: 25%;">
                    <img class="card-img-top" style="height: 10rem;" src="<?php echo $good['img']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $good['name']; ?></h5>
                        <p class="price"><?php echo $good['price']; ?></p>
                        <p class="description"><?php echo $good['description']; ?></p>
                        <div class="d-flex justify-content-center">
                        <a style="margin: 10px 0;" href="buy.php?id=<?php echo $good['id']; ?>" class="btn btn-success">Buy</a>
                        <a style="margin: 10px;" href="edit.php?id=<?php echo $good['id']; ?>" class="btn btn-primary">Edit</a>
                        <a style="margin: 10px 0;" href="delete.php?id=<?php echo $good['id']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pages">
            <ul class="pagination">
            <?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
                <li class="page-item">
                    <a class="text-secondary page-link<?php echo $offset / $numberOfItemsPerPagination + 1 == $i ? ' active' : ''; ?>" href="index.php?offset=<?php echo $numberOfItemsPerPagination * ($i - 1); ?>">
                    <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </main>
    <?php require __DIR__ . '/incl/footer.php'; ?>