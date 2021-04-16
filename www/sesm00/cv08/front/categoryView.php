<?php
require __DIR__ . '/../includes/classes/CategoriesDB.php';

/*
INSERT INTO `cv06_categories` (`id`, `name`, `number`) VALUES
(NULL, 'Škoda', '1'),
(NULL, 'BMW', '2'),
(NULL, 'Audi', '3'),
(NULL, 'VW', '4')
*/

$categoriesDB = new CategoriesDB();

$categories = $categoriesDB->fetchAll();

?>
<div class="list-group">
    <?php foreach ($categories as $category): ?>
        <a href="#" class="list-group-item"><?php echo $category['name']; ?></a>
    <?php endforeach; ?>
</div>
