<?php require_once __DIR__ . '/../lib/CategoriesDB.php'; ?>
<?php

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();

?>
<div class="container">

    <div class="row">
        <div class="list-group">
            <?php foreach ($categories as $category) : ?>
                <a href="#" class="list-group-item"><?php echo '(', $category['number'], ') ', $category['name']; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>