<?php require_once __DIR__ . '/../class/CategoriesDB.php'; ?>
<?php

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();
?>
<footer id="footer">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-6 col-sm-6">
					<div class="footer">
						<h3 class="footer-title">About Us</h3>
						<p>This is an e-commerce website for subject 4IZ278 by student Lukáš Vít.</p>
						<ul class="footer-links">
							<li><a href="#"><i class="fa fa-map-marker"></i>Somewhere over the rainbow</a></li>
							<li><a href="#"><i class="fa fa-phone"></i>+420 832 921 029</a></li>
							<li><a href="#"><i class="fa fa-envelope-o"></i>admin@admin.cz</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3 col-xs-6 col-sm-6">
					<div class="footer">
						<h3 class="footer-title">Categories</h3>
						<ul class="footer-links">
							<?php foreach ($categories as $category) : ?>
								<li><a href="category.php?category=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a></li>

							<?php endforeach; ?>


						</ul>
					</div>
				</div>

				<div class="col-md-3 col-xs-6 col-sm-6">
					<div class="footer">
						<h3 class="footer-title">Information</h3>
						<ul class="footer-links">
							<li><a href="#">About Us</a></li>
							<li><a href="#">Contact Us</a></li>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">Orders and Returns</a></li>
							<li><a href="#">Terms & Conditions</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3 col-xs-6 col-sm-6">
					<div class="footer">
						<h3 class="footer-title">Service</h3>
						<ul class="footer-links">
							<li><a href="index.php?page=profile">My Account</a></li>
							<li><a href="index.php?page=cart">View Cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="bottom-footer" class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<span class="copyright">
						<a href="#" target="_blank">© Created by Lukáš Vít</a>
					</span>
				</div>
			</div>
		</div>
	</div>
</footer>



<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>