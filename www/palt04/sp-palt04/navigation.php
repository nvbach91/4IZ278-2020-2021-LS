<?php ?>
<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php"><img src="resources/img/nba_logo.png" height="40px"></a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <?php if (!isset($_SESSION['user_email'])): ?>
                <li class="nav-item mr-3">
                  <a href="login.php" class="btn btn-info font-weight-bold" style="padding: 7px;">Login</a>
                </li>
                <li class="nav-item">
                  <a href="registration.php" class="btn btn-outline-info font-weight-bold" style="padding: 7px;">Sign Up</a>
                </li>
                              
          <?php else: ?>  
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['user_email'];?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php if($_SESSION['admin']):?>
              <a class="dropdown-item" href="users.php">Users</a>
              <a class="dropdown-item" href="create-product.php">Add Product</a>
            <?php  else: ?>
              
              <a class="dropdown-item" href="orders.php">Orders</a>
              <a class="dropdown-item" href="cart.php">Cart</a>
            <?php endif; ?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">Log out</a>
            </div>
        </li>
  
          <?php endif; ?>
        </ul>    
      </div>
    </div>
  </nav>