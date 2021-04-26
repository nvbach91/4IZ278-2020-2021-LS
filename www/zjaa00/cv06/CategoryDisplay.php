<?php 

require "./CategoriesDB.php";

$categories_db = new CategoriesDB();

/* $categories = [
  ['number' => '1', 'name' => 'Alphonso'],
  ['number' => '2', 'name' => 'Chaunsa'],
  ['number' => '3', 'name' => 'Langra'],
  ['number' => '4', 'name' => 'Benishan'],
];


foreach($categories as $category) {
  $categories_db->create($category);
} */

$categories = $categories_db->fetchAll();

?>

  <div class="list-group">

    <?php foreach($categories as $category): ?>
      <a href="#" class="list-group-item"><?= "(" . $category['number'] . ")" . $category['name'] ?></a>
    <?php endforeach; ?>

  </div>