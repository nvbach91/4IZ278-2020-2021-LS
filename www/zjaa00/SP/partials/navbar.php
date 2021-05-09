<nav>
  <h1
  unselectable="on"
  onselectstart="return false;" 
  onmousedown="return false;"
  class="logo">Nebra</h1>
  <div class="searchbar">
    <i class="fas fa-search search_icon"></i>
    <input class="search_input" type="text" autocomplete="off" placeholder="<?= $searchPlaceholder ?>">
    <i class="fas fa-times clear_icon" style="display: none;"></i>
  </div>
  <div class="links">
    <a href="<?= $base_url ?>#drinks">Drinky</a>
    <a href="<?= $base_url ?>#atmosphere">Atmosféra</a>
    <a href="<?= $base_url ?>#contact">Kontakt</a>
  </div>
  
  <?php if (@$_COOKIE['privilege'] == 1): ?>
    <div class="user menu">
      <i id="menu" class="fas fa-bars"></i>
    </div>
  <?php elseif(@($_COOKIE['privilege']) > 1): ?>
    <div class="user logout">
      <a class="btn btn-danger" href="logout.php">Odhlásiť sa</a>
    </div>
  <?php elseif(!isset($_COOKIE['privilege'])): ?>
    <div class="user login">
      <a href="login.php">
        <i class="fas fa-sign-in-alt"></i>
        <p>&nbsp;Prihlásiť</p>
      </a>
    </div>
    
  <?php endif; ?>

</nav>

<?php
  include('filter.php');
  if (@$_COOKIE['privilege'] == 1) {
    include('order.php');
  }
?>

<div class="mobile_links">
  <a href="<?= $base_url ?>#drinks">Drinky</a>
  <a href="<?= $base_url ?>#atmosphere">Atmosféra</a>
  <a href="<?= $base_url ?>#contact">Kontakt</a>
</div>