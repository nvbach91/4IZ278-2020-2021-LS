<?php

function active($current_page) {
    $url_array =  explode('/', $_SERVER['REQUEST_URI']);
    $url = end($url_array);
    if ($current_page == $url) {
        echo 'active';
    }
}

$url_array =  explode('/', $_SERVER['REQUEST_URI']);
$url = end($url_array);

$isLoggedIn = isset($_COOKIE['username']);

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MangoShop</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="stylesheet" href="css/styles.css">

</head>


<body class="bg-secondary text-white">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Mango Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?php active('index.php')?>">
            <a class="nav-link" href="./index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php if(isset($_COOKIE['username'])) : ?>
            <li class="nav-item <?php active('cart.php')?>">
              <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart" style="padding-right: 2px;"></i>Cart</a>
            </li>
            <li class="nav-item <?php active('profile.php')?>">
              <a class="nav-link" href="profile.php">
                <i class="fas fa-user" style="padding-right: 2px;"></i>
                <?php echo @$_COOKIE['username']; ?>
              </a>
            </li>
            <li class="nav-item <?php active('logout.php')?>">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item <?php active('login.php')?>">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>