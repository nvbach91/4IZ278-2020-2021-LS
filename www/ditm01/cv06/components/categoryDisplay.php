<?php require './db/categoriesDB.php'; ?>
<?php
$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();
?>

<div class="col-lg-3">
    <h1 class="my-4">Fruit shop</h1>
    <div class="list-group">
        <?php foreach($categories as $category) : ?>
        <a href="#" class="list-group-item"><?php echo $category['name']; ?></a>
        <?php endforeach; ?>
    </div>
</div>