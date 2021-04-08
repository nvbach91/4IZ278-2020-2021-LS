<?php
$categoryDB = new CategoriesDB();
$categories = $categoryDB->fetch();
?>
<div class="col-lg-3">

    <h1 class="my-4">Categories</h1>
    <div class="list-group">

        <?php foreach ($categories as $c) : ?>
            <a href="#" class="list-group-item"><?php echo $c['name']; ?></a>
        <?php endforeach; ?>
        <!--
        <a href="#" class="list-group-item">Category 1</a>
        <a href="#" class="list-group-item">Category 2</a>
        <a href="#" class="list-group-item">Category 3</a>
        -->
    </div>
</div>
