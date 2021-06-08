<?php require __DIR__ . '/../db/categoriesDB.php'; ?>
<?php
     $categoriesDB = new CategoriesDB();
     $categories = $categoriesDB->fetchAll();
?>  
<a class="text-decoration-none text-warning" href="beers.php">Vše</a>
<?php foreach($categories as $category): ?>
    <?php if($category['cat_name']=="Vaření piva"):?>
    <?php elseif(empty($_GET['id_category'])): ?>
        - <a class="text-decoration-none text-warning" href='beers.php?id_category=<?php echo $category['id_category']?>'><?php echo $category['cat_name']?></a>
    <?php elseif(($_GET['id_category']) == $category['id_category']): ?>
        - <a class="text-decoration-none text-dark" href='beers.php?id_category=<?php echo $category['id_category']?>'><?php echo $category['cat_name']?></a>    
    <?php else: ?>
        - <a class="text-decoration-none text-warning" href='beers.php?id_category=<?php echo $category['id_category']?>'><?php echo $category['cat_name']?></a> 
    <?php endif ?>  
<?php endforeach; ?>