<?php require_once __DIR__ . '/../db/CategoriesDB.php'; ?>
<?php require_once __DIR__ . '/../config/global.php'; ?>
<?php
$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();
?>
<div class="list-group">
    <?php foreach ($categories as $category) : ?>
        <a href=<?php echo URL . '/products/category.php?categoryId=' . $category['id'] ?> class="list-group-item"
        <?php if(isset($_GET['categoryId'])&&$_GET['categoryId']==$category['id']){echo 'style="font-weight: bold;"';}?>><?php echo '(', $category['number'], ') ', $category['name']; ?></a>
    <?php endforeach; ?>
</div>