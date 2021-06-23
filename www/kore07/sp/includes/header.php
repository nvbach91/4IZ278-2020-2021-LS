<?php 
  if(!isset($_SESSION)){
    session_start();
  }

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  $count = 0;

  foreach ($_SESSION['cart'] as $key=>$value) {
    $count = $count + $_SESSION['cart'][$key]['qnt'];
  };

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="electro idevice device gopro drone">
    <meta name="author" content="Kortoshkina Katerina">
    <title>iDevice Electro Inc.</title>
    <link rel="shortcut icon" href="img/favicon.png">
    <link href="css/normalize.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
</head>


<body class="page">
  <div class="main-container">
    <header class="main-header">
      <a class="logo-link" href="index.php">
        <img class="main-logo" src="img/logo.svg" width="163" height="35" alt="Logo iDevice" />
      </a>
      <ul class="user-navigation">
        <li class="user-navigation-item search-item">
          <form class="search-form" method="post" action="">
            <input class="search-form-input" type="search" name="search" placeholder="Search" />
            <button type="submit" class="search-form-button">Search</button>
          </form>
        </li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li class="user-navigation-item profile-item">
              <a class="user-navigation-link profile-link" href="profile.php"> <?php echo $_SESSION['user_email']; ?></a>
            </li>
            <li class="user-navigation-item signout-item">
              <a class="user-navigation-link signout-link" href="components/signout.php"></a>
            </li>
        <?php else: ?>
            <li class="user-navigation-item signin-item">
              <a class="user-navigation-link login-link" href="signin.php">Sign in</a>
            </li>
        <?php endif; ?>
        <li class="user-navigation-item cart-item">
          <a class="user-navigation-link cart-link" href="cart.php">
            Cart
            <?php if (isset($_SESSION['cart'])): ?>
              <span class="user-navigation-item cart-count">(<?php echo $count; ?>)</span>
            <?php endif; ?>
          </a>
        </li>
      </ul>
      <nav class="main-nav">
        <ul class="nav-list">
          <li class="nav-item">
            <a class="nav-link nav-catalog" href="catalog.php">Products</a>
            <ul class="nav-catalog-list">
              <li class="nav-catalog-item">
                <a class="nav-catalog-link" href="catalog.php">Virtual reality</a>
              </li>
              <li class="nav-catalog-item">
                <a class="nav-catalog-link" href="catalog.php">Monopods for selfie</a>
              </li>
              <li class="nav-catalog-item">
                <a class="nav-catalog-link" href="catalog.php">GoPro</a>
              </li>
              <li class="nav-catalog-item">
                <a class="nav-catalog-link" href="catalog.php">Trackers</a>
              </li>
              <li class="nav-catalog-item">
                <a class="nav-catalog-link" href="catalog.php">Smartwatches</a>
              </li>
              <li class="nav-catalog-item">
                <a class="nav-catalog-link" href="catalog.php">Drones</a>
              </li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link delivery-link" href="#">Shipping</a></li>
          <li class="nav-item"><a class="nav-link guarantee-link" href="#">Payment</a></li>
          <li class="nav-item"><a class="nav-link contacts-link" href="#">Contact Us</a></li>
        </ul>
      </nav>
    </header>
  </div>