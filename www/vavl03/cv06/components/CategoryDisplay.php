<?php require __DIR__ . '/../db/CategoryDB.php'; ?>
<?php
/* INSERT INTO `categories` (`number `, `name`) VALUES
(1,'4x4'),
(2,'Kombi'),
(3,'SUV'),
(4,'Kombi');
*/
// fetch from database
$categoriesDB = new CategoryDB();
$categories = $categoriesDB->fetchAll();
?>
<div class="list-group">
    <?php foreach($categories as $category): ?>
    <a href="#" class="list-group-item"><?php echo '(', $category['number'], ') ', $category['name']; ?></a>
    <?php endforeach; ?>
</div>