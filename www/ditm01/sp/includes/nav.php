<?php
if (!isset($_SESSION)) {
  session_start();
}
?>


<nav class="navbar navbar-expand-md py-2 mb-3 navbar-dark bg-dark">
  <div class="container-fluid d-flex justify-content-center">
    <a class="navbar-brand ms-5 text-uppercase" href="index.php">MechPress</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav nav-pills mx-auto">
        <li class="nav-item px-2">
          <a class="nav-link text-uppercase <?php echo strpos($_SERVER['REQUEST_URI'], 'index') ? ' active' : '' ?>" href="index">Home</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link text-uppercase <?php echo strpos($_SERVER['REQUEST_URI'], 'shop') ? ' active' : '' ?>" href="shop">Shop</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link text-uppercase <?php echo strpos($_SERVER['REQUEST_URI'], 'contact') ? ' active' : '' ?>" href="contact">Contact</a>
        </li>
      </ul>
      <ul class="navbar-nav me-5 d-flex flex-row">
        <?php if (isset($_SESSION['user_id'])) : ?>
          <li class="nav-item px-1 my-auto">
            <a class="nav-link text-uppercase <?php echo strpos($_SERVER['REQUEST_URI'], 'logout') ? ' active' : '' ?>" href="logout">Logout</a>
          </li>
        <?php else : ?>
          <li class="nav-item px-1">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>" href="login">
              <i class="bi bi-person-circle fs-4"></i>
            </a>
          </li>
        <?php endif; ?>
        <li class="nav-item px-1">
          <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>" href="cart">
            <i class="bi bi-basket3-fill fs-4"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>