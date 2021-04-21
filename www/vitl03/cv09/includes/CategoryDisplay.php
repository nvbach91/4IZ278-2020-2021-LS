<?php require __DIR__ . '/../CategoriesDB.php'; ?>
<?php

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();
?>

<div class="list-group">
    <?php foreach ($categories as $category) : ?>
        <a href="#" class="list-group-item"> <?php echo $category['name'] . ' (' . $category['number'] . ')'; ?></a>
    <?php endforeach; ?>
</div>