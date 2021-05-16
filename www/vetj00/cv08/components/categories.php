<?php
    require __DIR__ . '/../database/categoriesDB.php';

    $categoriesDB = new CategoriesDB();

    $categories = $categoriesDB->fetchAll();
?>

<div class="list-group">
    <?php foreach ($categories as $category) : ?>
        <a href="#" class="list-group-item"><?php echo $category['name'], ' (', $category['pocet_cat'], ')'; ?></a>
    <?php endforeach; ?>
</div>