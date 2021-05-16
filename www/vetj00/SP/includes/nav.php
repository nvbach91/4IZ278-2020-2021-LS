<nav class="navbar navbar-expand-md py-3 navbar-light">
  <div class="container-fluid d-flex justify-content-center">
    <a class="navbar-brand ms-5 text-uppercase" href="index.php">Optishop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav nav-pills mx-auto">
        <li class="nav-item px-2">
          <a class="nav-link text-uppercase <?php echo strpos($_SERVER['REQUEST_URI'], 'index') ? ' active' : '' ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link text-uppercase <?php echo strpos($_SERVER['REQUEST_URI'], 'contact') ? ' active' : '' ?>" href="contact.php">Contact</a>
        </li>
      </ul>
      <ul class="navbar-nav me-5 d-flex flex-row">
        <li class="nav-item px-1">
          <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>" href="login.php">
            <i class="fa fa-user"></i>
          </a>
        </li>
        <li class="nav-item px-1">
          <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>" href="cart.php">
            <i class="fa fa-shopping-cart"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav> 