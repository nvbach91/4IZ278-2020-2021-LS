				<?php

				if ((!($_SESSION['user_id'])) || (!$_SESSION['user_privilege'] > 2)) {
					header('Location: index.php');
					die();
				}
				?>
				<?php include __DIR__ . '/includes/header.php' ?>
				<nav id="navigation">
					<div class="container">
						<div id="responsive-nav">
							<ul class="main-nav nav navbar-nav">
								<li><a href="index.php?page=create-item">New item</a></li>
								<li><a href="index.php?page=users">Users</a></li>
							</ul>
						</div>
					</div>
				</nav>

				<div class="container style='margin-top:100px'">
					<div class="row justify-content-center">
						<br>

						<h1>Welcome to Admin Page</h1>
						<h2>Profile details:</h2>
						<br>
						<div class="col-md-9">
							<table class="table table-hover table-bordered">
								<tbody>
									<tr>
										<td>ID</td>
										<td><?php echo $_SESSION['user_id']; ?></td>
									</tr>
									<tr>
										<td>Email address</td>
										<td><?php echo $_SESSION['user_email'] ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>









				<?php include __DIR__ . '/includes/newsletter.php' ?>

				<?php include __DIR__ . '/includes/footer.php' ?>