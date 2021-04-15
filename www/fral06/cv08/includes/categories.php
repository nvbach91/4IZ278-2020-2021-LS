<?php


require "model/CategoriesDB.php";

$categories = new CategoriesDB();
$data = $categories->fetch();


?>

<div class="list-group">
    <?php foreach ($data as $category): ?>
    <a href="#" class="list-group-item"><?php echo $category['name']; ?></a>
    <?php endforeach; ?>
</div>