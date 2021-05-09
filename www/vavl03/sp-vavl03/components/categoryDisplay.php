<?php require __DIR__ . '/../db/CategoryDB.php'; ?>
<?php
$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();
?>
<div class="categories">
    <h2>Categories:</h2>
    <div class="col-lg-12">
        <?php foreach ($categories as $category) : ?>
            <a class="btn btn-outline-info category-btn
            <?php echo strpos($_SERVER['REQUEST_URI'], $category['category_name']) ? ' active-category' : '' ?>" href='index.php?category=<?php echo $category['category_name']; ?>'><?php echo $category['category_name']; ?></a>
        <?php endforeach; ?>
    </div>
    <?php if (strpos($_SERVER['REQUEST_URI'], 'category')) : ?>
        <div class="cancel-category">
            <a href="index.php">
                <i class="far fa-times-circle"></i>
                <span>cancel category</span>
            </a>
        </div>
    <?php endif; ?>
</div>