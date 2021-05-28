<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Active</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<link rel="stylesheet" href="css/font-awesome.min.css">

	<link type="text/css" rel="stylesheet" href="css/style.css" />


</head>

<body>

	<header>

		<div id="header">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<a href="index.php?page=home">

							<div class="logo">
								<div class="content-white"><a href="index.php?page=home" style="text-decoration:none; color:white;">Active</a></div>
								<div class="circ-pink"></div>
							</div>
						</a>

					</div>

					<div class="col-md-6 col-sm-9 col-xs-12">
						<div class="header-search">
							<form method="get" action="search.php">
								<input type="text" name="search" class="input" placeholder="Search here">
								<input type="submit" class="search-btn" value="Search">
							</form>
						</div>
					</div>





					<div class="col-md-3 clearfix col-sm-12 col-xs-12">
						<div class="header-ctn">

							<div class="dropdown">

								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-user"></i>
									<span>My profile</span>
								</a>

								<div class="profile-dropdown">
									<div class="profile-list">


										<div class="row">
											<?php if (isset($_SESSION['user_id'])) : ?>
												<?php if ($_SESSION['user_privilege'] > 2) : ?>
													<a class="profile-dropdown-btn" href="index.php?page=admin">Profile details</a>
												<?php else : ?>
													<a class="profile-dropdown-btn" href="index.php?page=profile">Profile details</a>
												<?php endif; ?>
											<?php elseif (isset($_SESSION['access_token'])) : ?>
												<a class="profile-dropdown-btn" href="index.php?page=profile">Profile details</a>

											<?php else :  ?>
												<a class="profile-dropdown-btn" href="index.php?page=signin">Profile details</a>
											<?php endif; ?>

										</div>
										<?php if (isset($_SESSION['user_id']) || isset($_SESSION['access_token'])) : ?>
											<div class="row">
												<a class="profile-dropdown-btn-red" href="index.php?page=logout">Logout</a>
											</div>
										<?php else : ?>
											<div class="row">
												<a class="profile-dropdown-btn" href="index.php?page=signin">Sign in</a>
												<div class="row">
												</div>
												<a class="profile-dropdown-btn" href="index.php?page=signup">Sign up</a>
											</div>
										<?php endif; ?>

									</div>
								</div>
							</div>
							<div>
								<a href="index.php?page=cart">
									<i class="fa fa-shopping-cart"></i>
									<a class="nav-link" href="index.php?page=cart">Cart</a>
								</a>
							</div>


							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</header>