<nav>
  <h1 class="logo unselectable">Nebra</h1>
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
  
  <!-- podľa typu uživateľa zobrazíme buď menu s objednávkou (uživateľ),možnosť odhlásenia (admin), možnosť prihlásenia (všetci ostatní) -->
  <?php if (authorize(1)): ?>

    <div class="user menu">
      <i id="menu" class="fas fa-bars"></i>
    </div>

  <?php elseif(authorize(2)): ?>

    <div class="user logout">
      <a class="btn btn-danger" href="logout.php">Odhlásiť sa</a>
    </div>

  <?php else: ?>

    <div class="user login">
      <a href="login.php">
        <i class="fas fa-sign-in-alt"></i>
        <p>&nbsp;Prihlásiť</p>
      </a>
    </div>
    
  <?php endif; ?>

</nav>

<!-- ak sa jedná o prihláseného uživateľa, tak zobrazíme menu slider -->
<?php
  require "./partials/homepage/filter.php";
  if (authorize(1)) {
    require "./partials/homepage/order.php";
  }
?>

<!-- pre mobilnú verziu sú pripravené momentálne skryté linky -->
<div class="mobile_links" style="display: none;">
  <a href="<?= $base_url ?>#drinks">Drinky</a>
  <a href="<?= $base_url ?>#atmosphere">Atmosféra</a>
  <a href="<?= $base_url ?>#contact">Kontakt</a>
</div>

<!-- možnosti pre admina pre pridávanie položiek do databázy -->
<?php if(authorize(2)): ?>
  <div id="create_buttons">
    <div class="btn-group">
      <a href="create_item.php" class="btn btn-light">Nový drink</a>
      <a href="ingredients.php" class="btn btn-outline-light">Ingrediencie</a>
      <a href="create_ingredient.php" class="btn btn-outline-light"><i class="fas fa-plus"></i></a>
    </div>
  </div>
<?php endif; ?>