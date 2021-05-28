<?php include __DIR__ . '/includes/header.php' ?>
<?php

if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_email']) && !isset($_SESSION['access_token'])) {
	header('Location: index.php');
	die();
}


?>


<?php include __DIR__ . '/includes/navigationProfile.php' ?>

<div class="container style='margin-top:100px'">
	<div class="row justify-content-center">
		<br>
		<h1>Welcome to Profile Page</h1>
		<h2>Profile details:</h2>
		<?php if (isset($_SESSION['userData'])) : ?>
			<div class="col-md-3">

				<img src="<?php echo $_SESSION['userData']['picture']['url']; ?>">
			</div>
			<div class="col-md-9">
				<table class="table table-hover table-bordered">
					<tbody>
						<tr>
							<td>ID</td>
							<td><?php echo $_SESSION['userData']['id']; ?></td>
						</tr>
						<tr>
							<td>First Name</td>
							<td><?php echo $_SESSION['userData']['first_name']; ?></td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><?php echo $_SESSION['userData']['last_name']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $_SESSION['userData']['email']; ?></td>
						</tr>
					</tbody>
				</table>
				<a href="index.php?page=logout"><button style="margin-bottom:20px;" class="primary-btn">logout</button></a>
			</div>
		<?php elseif (isset($_SESSION['access_token'])) : ?>
			<div class="col-md-3">
				<img src="<?php echo $_SESSION['user_image'] ?>">
			</div>
			<div class="col-md-9">
				<table class="table table-hover table-bordered">
					<tbody>
						<tr>
							<td>First Name</td>
							<td><?php echo $_SESSION['user_first_name']; ?></td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><?php echo $_SESSION['user_last_name']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $_SESSION['user_email'] ?></td>
						</tr>

					</tbody>
				</table>

				<a href="index.php?page=logout"><button style="margin-bottom:20px;" class="primary-btn">logout</button></a>
			</div>



		<?php else : ?>
			<div class="col-md-9">
				<table class="table table-hover table-bordered">
					<tbody>
						<tr>
							<td>ID</td>
							<td><?php echo $_SESSION['user_id']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $_SESSION['user_email'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php endif; ?>



	</div>


</div>








<?php include __DIR__ . '/includes/newsletter.php' ?>

<?php include __DIR__ . '/includes/footer.php' ?>