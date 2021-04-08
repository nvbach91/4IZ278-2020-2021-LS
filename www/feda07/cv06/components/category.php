<?php
require __DIR__.'/../database/CategoryDB.php';
$database = new CategoryDB();

$categories =$database->fetchAll();

?>

<div class="col-lg-3">

    <h1 class="my-4">Shampoo shop</h1>
    <div class="list-group">
        <?php foreach($categories as $category): ?>
        <a href="#" class="list-group-item"><?php echo $category['name'] . ' ' . '(' . $category['number'] . ')' ?></a>
        <?php endforeach; ?>
    </div>

</div>
<!-- /.col-lg-3 -->