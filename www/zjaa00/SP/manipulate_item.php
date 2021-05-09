<?php
  include "./partials/header.php";
  require "./_inc/config.php";

  if ($_GET['drink_id']):
    
    if (isset($_GET['available'])) {
      $stmt = $connect->prepare("
        UPDATE drinks SET
        available = :available
        WHERE drink_id = :drink_id;
      ");
      $stmt->execute([
        "available" => $_GET['available'],
        "drink_id" => $_GET['drink_id'],
      ]);

      header("Location: ./index.php");
    }

    $was_ordered = $connect->prepare("
      SELECT order_id FROM drinks_orders
      WHERE drink_id = :drink_id;;
    ");
    $was_ordered->execute([
      "drink_id" => $_GET['drink_id'],
      ]);
    @$was_ordered = $was_ordered->fetchColumn();

    var_dump($was_ordered);
    
    if (@$was_ordered): ?>
      <body style="background-color: white;">
        <div class="card text-dark bg-info mb-3" style="width: 18rem; margin: 20px auto;">
          <div class="card-body">
            <h5 class="card-title">Upozornenie</h5>
            <h6 class="card-subtitle mb-2 text-muted">Stiahnutie z predaja</h6>
            <p class="card-text">
              Drink už si niekto na svojom účte objednal a má ho vo svojich
              objednávkach. Pre zachovanie dát užívateľa sa tento drink už
              nedá vymazať permanentne. Je však možné ho stiahnuť z predaja,
              a tým pádom ho bežnému užívateľovi nezobraziť pri používaní
              online menu zatiaľ, čo bude stále v databáze a viditeľný
              pre admina.
            </p>
            <a class="btn btn-light" href="./manipulate_item.php?drink_id=<?= $_GET['drink_id'] ?>&available=0" class="card-link">Stiahnuť z predaja</a>
              alebo
            <a href="./index.php" class="card-link">späť</a>
          </div>
        </div>
      </body>
    <?php else:

      $delete = $connect->prepare("
        DELETE FROM drinks
        WHERE drink_id = :drink_id;;
      ");
      $delete->execute([
        "drink_id" => $_GET['drink_id'],
      ]);

      header("Location: ./index.php");
    endif;
  endif;
  include "./partials/footer.php";