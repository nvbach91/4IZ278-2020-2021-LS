<?php require_once __DIR__ . '/../class/CategoriesDB.php'; ?>
<?php

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();

?>
<nav id="navigation">
	<div class="container">
		<div id="responsive-nav">
			<ul class="main-nav nav navbar-nav">
				<?php if (stripos($_SERVER['REQUEST_URI'], 'index.php?page=home')) : ?>
					<?php foreach ($categories as $category) : ?>
						<li><a href="category.php?category=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a></li>

					<?php endforeach; ?>
				<?php else : ?>
					<li><a href="index.php?page=home">Home</a></li>
					<?php foreach ($categories as $category) : ?>
						<li><a href="category.php?category=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a></li>

					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>