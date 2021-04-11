<nav>
  <h1
  unselectable="on"
  onselectstart="return false;" 
  onmousedown="return false;"
  class="logo">Nebra</h1>
  <div class="links">
    <a href="<?= $base_url ?>#drinks">Drinky</a>
    <a href="<?= $base_url ?>#atmosphere">Atmosféra</a>
    <a href="<?= $base_url ?>#contact">Kontakt</a>
  </div>
  <div id="wrapper">
    <i id="search-icon" class="fas fa-search"></i>
    <input id="search" type="text" autocomplete="off" placeholder="<?= $searchPlaceholder ?>">
    <i id="clear-icon" class="fas fa-times" style="display: none;"></i>
  </div>
</nav>

<?php include('filter.php') ?>

<div class="nav">
  <a href="<?= $base_url ?>#drinks">Drinky</a>
  <a href="<?= $base_url ?>#atmosphere">Atmosféra</a>
  <a href="<?= $base_url ?>#contact">Kontakt</a>
</div>