<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Active</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />


</head>

<body>
	<!-- HEADER -->
	<header>


		<!-- MAIN HEADER -->
		<div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							<a href="index.php" class="logo">
								<img src="./img/logoLV_white.png" width="60px" height="60px" alt="logo">
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<form>
								<input class="input" placeholder="Search here">
								<button class="search-btn">Search</button>
							</form>
						</div>
					</div>
					<!-- /SEARCH BAR -->

					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-user"></i>
									<span>My profile</span>
								</a>
								<div class="profile-dropdown">
									<div class="profile-list">


										<div class="row">
											<a class="profile-dropdown-btn" href="profile.php">Profile details</a>
										</div>
										<?php if (isset($_SESSION['user_id'])) : ?>
											<div class="row">
												<a class="profile-dropdown-btn-red" href="logout.php">Logout</a>
											</div>
										<?php else: ?>
											<div class="row">
											<a class="profile-dropdown-btn" href="signin.php">Sign in</a>
											<div class="row">
											</div>
											<a class="profile-dropdown-btn" href="signup.php">Sign up</a>
										</div>
										<?php endif; ?>
										
									</div>
								</div>
							</div>
							<!-- Cart -->
							<div>
								<a href="cart.php">
									<i class="fa fa-shopping-cart"></i>
									<a class="nav-link" href="cart.php">Cart</a>
								</a>
							</div>
							<!-- /Cart -->

							<!-- Menu Toogle -->
							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
							<!-- /Menu Toogle -->
						</div>
					</div>
					<!-- /ACCOUNT -->
				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</div>
		<!-- /MAIN HEADER -->
	</header>
	<!-- /HEADER -->