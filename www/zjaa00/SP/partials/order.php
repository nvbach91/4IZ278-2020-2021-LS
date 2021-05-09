<?php 
  $statement = $connect->prepare("SELECT drink_id, name, volume, price FROM drinks WHERE available = 1 ORDER BY name asc;");
  $statement->execute();
  $drinks = $statement->fetchAll();
?>
  <div id="menu_slider" style="display: none;">
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Odhlásiť</a>
    <hr>
    <div class="content">
      <div class="head">
        <h3>Objednávka</h3>
        <a href="orders.php">Viac <i class="fas fa-angle-double-right"></i></a>
      </div>
      <form action="orders.php" method="POST">
        <div class="my_order">
        <?php 
        if(@$_SESSION['order']):
          foreach($_SESSION['order'] as $id => $item): ?>
            <div class="order_item">
              <select name="drink" required>
                <?php foreach($drinks as $drink): echo $id; ?>
                  <option value="<?= $drink['drink_id'] ?>" <?= ($drink['drink_id'] == $id) ? "selected" : "" ?>><?= $drink['name'] ?></option>
                <?php endforeach; ?>
              </select>
              <p class="amount"><?= (int) $item['amount'] ?></p>
              <p>ks</p>
              <p>*</p>
              <p class="drink_price"><?= $item['price'] ?></p>
              <p>=<span class="drink_sum"><?= $item['sum'] ?></span></p>
              <div class="delete"><button class="delete_button"><i class="far fa-trash-alt"></i></button></div>
              <div class="minus"><button class="minus_button"><i class="fas fa-minus"></i></button></div>
              <div class="plus"><button class="plus_button"><i class="fas fa-plus"></i></button></div>
            </div>
          <?php endforeach; endif; ?>
        </div>
        <div class="overall">
          <p>CELKOM</p>
          <p><span class="order_sum">0.00</span> EUR</p>
        </div>
        <div id="order_options">
          <button id="add"><i class="fas fa-beer"></i></button>
          <button id="make_order">Objednané</button>
          <a href="./_inc/add_to_order.php?order_finished=1" id="pay">Zaplatené</a>
        </div>
      </form>
    </div>
  </div>

  <div id="blank_item" style="display: none;">
    <div class="order_item">
      <select name="drink" required>
        <option hidden value selected></option>
        <?php foreach($drinks as $drink): ?>
          <option value="<?= $drink['drink_id'] ?>"><?= $drink['name'] ?></option>
        <?php endforeach; ?>
      </select>
      <p class="amount">1</p>
      <p>ks</p>
      <p>*</p>
      <p class="drink_price">0.00</p>
      <p>=<span class="drink_sum">0.00</span></p>
      <div class="delete"><button class="delete_button"><i class="far fa-trash-alt"></i></button></div>
      <div class="minus"><button class="minus_button"><i class="fas fa-minus"></i></button></div>
      <div class="plus"><button class="plus_button"><i class="fas fa-plus"></i></button></div>
    </div>
  </div>