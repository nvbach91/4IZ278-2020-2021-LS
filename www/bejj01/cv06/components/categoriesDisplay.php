<?php
    require __DIR__ . '/../database/categoriesDB.php';

    $categoriesDB = new CategoriesDB();


    /*$categories = [
        ['number' => 1, 'name' => 'Fantasy'],
        ['number' => 2, 'name' => 'Detektivka'],
        ['number' => 3, 'name' => 'Sci-Fi'],
        ['number' => 4, 'name' => 'Sportovní'],
        ['number' => 5, 'name' => 'Kuchařka']
    ];*/

    /*
        foreach($categories as $newCategory) {
            $categoriesDB->create($newCategory);
        }
    */

    $categories = $categoriesDB->fetchAll();


?>

<div class="list-group">
    <?php foreach($categories as $category): ?>
        <a href="#" class="list-group-item text-white bg-info mb-2"><?php echo $category['name'], ' (', $category['pocet_cat'], ')'; ?></a>
    <?php endforeach; ?>
</div>