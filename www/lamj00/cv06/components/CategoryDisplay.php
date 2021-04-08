<?php
$DIR = substr_replace(__DIR__,"",-11);

require "$DIR/db_logic/categoriesDB.php";

$categoriesDB = new categoriesDB();
$categories = $categoriesDB->fetchAll();
?>

<div class="list-group">
    <?php foreach ($categories as $category):?>
    <a href="#" class="list-group-item"><?php echo $category["name"]?></a>
    <?php endforeach;?>
</div>
