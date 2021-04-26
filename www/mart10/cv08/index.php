<?php

require 'db.php';

if (!empty($_GET)) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

$itemsPerPagination = 4;

$numberOfGoods = $db->query("SELECT COUNT(id) FROM goods")->fetchColumn();

$sql = "SELECT * FROM goods WHERE 1 LIMIT $itemsPerPagination OFFSET ?;";
$statement = $db->prepare($sql);
$statement->bindValue(1,$offset, PDO::PARAM_INT);
$statement->execute();

$goods = $statement->fetchAll(PDO::FETCH_ASSOC);


$numberOfPages = ceil($numberOfGoods / $itemsPerPagination);
?>

<?php require './incl/header.php'; ?>
<nav>
        <?php if (@$_COOKIE['username']): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
</nav>
<div>Number of goods: <?php echo $numberOfGoods ?> </div>
<div class="pagination">
        <?php for($i = 1; $i <= $numberOfPages; $i++) { ?>
            <a class="<?php echo $offset / $itemsPerPagination + 1 == $i ? 'active' : ''; ?>" href="index.php?offset=<?php echo $itemsPerPagination * ($i - 1); ?>"><?php echo $i; ?></a>
        <?php }?>
        </div>
<div class="goods">
 <?php foreach($goods as $good): ?>
 <div class="good">
    <div class="image" style="background-image: url(<?php echo $good['img'] ?>);"></div>
    <div class="name"><?php echo $good['name']; ?></div>
    <div class="price"><?php echo $good['price']; ?></div>
    <div class="description"><?php echo $good['description']; ?></div>
    <div class="controls">
        <?php if (isset($_COOKIE['username'])) : ?>
            <a class="btn btn-secondary card-link" href='buy.php?id=<?php echo $good['id'] ?>'>Buy</a>
            <a class="btn btn-secondary card-link" href='edit-item.php?id=<?php echo $good['id'] ?>'>Edit</a>
            <a class="btn btn-secondary card-link" href='delete-item.php?id=<?php echo $good['id'] ?>'>Delete</a>
        <?php else : ?>
            <a class="btn btn-secondary card-link" href='buy.php?id=<?php echo $good['id'] ?>'>Buy</a>
        <?php endif; ?>
    </div>
</div>
 <?php endforeach; ?>
</div>
<div class="pagination">
        <?php for($i = 1; $i <= $numberOfPages; $i++) { ?>
            <a class="<?php echo $offset / $itemsPerPagination + 1 == $i ? 'active' : ''; ?>" href="index.php?offset=<?php echo $itemsPerPagination * ($i - 1); ?>"><?php echo $i; ?></a>
        <?php }?>
        </div>
        <?php require './incl/footer.php'; ?>