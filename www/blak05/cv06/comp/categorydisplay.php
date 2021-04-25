<?php require __DIR__ . '/../db/categoryDB.php'; ?>
<?php
    $categoriesDB = new CategoryDB();
    $categories = $categoriesDB->fetchAll();
?>
    <h1 class="my-4">Shop Name</h1>
    <div class="list-group">
      <?php foreach($categories as $category): ?>
        <a href="#" class="list-group-item"><?php echo $category['name']; ?></a>
      <?php endforeach; ?>
    </div>