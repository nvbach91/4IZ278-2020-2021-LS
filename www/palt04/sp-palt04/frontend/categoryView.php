<?php
// require __DIR__ . '/../includes/classes/CategoriesDB.php';

// $categoriesDB = new CategoriesDB();

//  $categories = $categoriesDB->fetchAll();

$stmt = $connect->prepare('SELECT * FROM categories');
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
        
<div class="list-group">
    <li class="list-group-item list-group-item-info">Categories</li>
    <?php foreach ($categories as $category): ?>
        <a href="index.php?categoryid=<?= $category['id'] ?>" class="list-group-item"><?php echo $category['name']; ?></a>
    <?php endforeach; ?>
</div>