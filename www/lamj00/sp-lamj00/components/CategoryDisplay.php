<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "db/CategoriesDB.php";
//
//$categories = [
//    ['number' => 0, 'name' => 'Processors'],
//    ['number' => 1, 'name' => 'Motherboards'],
//    ['number' => 2, 'name' => 'RAM'],
//    ['number' => 3, 'name' => 'HDD'],
//    ['number' => 3, 'name' => 'SSD'],
//    ['number' => 3, 'name' => 'Graphics cards'],
//    ['number' => 3, 'name' => 'Coolers'],
//];
// fetch from database

$catDB = new categoriesDB();
$categories = $catDB->fetchAll();


?>
<div class="list-group">
    <?php foreach($categories as $category): ?>
    <a href="eshop.php?category=<?php echo $category['ID']?>" class="list-group-item <?php echo @$_GET["category"] == $category['ID'] ? ' active' : '' ?>"><?php echo  $category['category_name']; ?></a>
    <?php endforeach; ?>
</div>
