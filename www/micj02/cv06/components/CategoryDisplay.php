<?php require __DIR__ . '/../database/CategoryDB.php'; ?>
<?php
$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();
?>
<div class="col-lg-3">
    <h1 class="my-4">Destiláty a liehoviny</h1>
    <div class="list-group">
        <?php foreach($categories as $category): ?>
            <a href="#" class="list-group-item"><?php echo  $category['name'] . ' ' . $category['number']; ?></a>
        <?php endforeach; ?>
    </div>
</div>
