<?php
  require "./partials/header.php";
  require "./_inc/require_admin.php";
  require "./classes/Drink.php";

  $drinks_images = array_slice(scandir("./img/items/"), 2);
?>

<body id="admin_page">

<h1>Vytvoriť drink</h1>

<?php
  if (@$_POST):
    
    $select = $connect->prepare("
      SELECT * from drinks WHERE name = :drink_name;
    ");
    $select->execute([":drink_name" => $_POST['drink_name']]);
    $exists = $select->fetchColumn();
    
    //ak neexistuje drink s daným menom, tak ho vytvoríme - inak vyhodíme chybovú hlášku
    if (!$exists):
      
      $drink_name = trim($_POST['drink_name']);
      $drink_volume = round((float) $_POST['drink_volume'], 2);
      $price = round((float) $_POST['price'], 2);
      $image = trim($_POST['image']);
      $alcoholic = isset($_POST['alcoholic']) ? 1 : (int) 0;
      $inflammatory = isset($_POST['inflammatory']) ? 1 : (int) 0;
      $deadly = isset($_POST['deadly']) ? 1 : (int) 0;
      
      /* $insert = $connect->prepare("
        INSERT INTO drinks (name, volume, price, image, alcoholic, inflammatory, deadly, available)
        VALUES (:drink_name, :drink_volume, :price, :image, :alcoholic, :inflammatory, :deadly, :available);
      ");
      $insert->execute([
        ":drink_name" => $drink_name,
        ":drink_volume" => $drink_volume,
        ":price" => $price,
        ":image" => $image,
        ":alcoholic" => $alcoholic,
        ":inflammatory" => $inflammatory,
        ":deadly" => $deadly,
      ]); */

      $drink = new Drink($connect);
      $args = ([
        ":name" => $drink_name,
        ":volume" => $drink_volume,
        ":price" => $price,
        ":image" => $image,
        ":alcoholic" => $alcoholic,
        ":inflammatory" => $inflammatory,
        ":deadly" => $deadly,
        ":available" => 1,
      ]);
      $drink->create($args);
      
      //odchytíme si ID novovytvoreného drinku
      $drink_id = $connect->lastInsertId();
    ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Úspešne</strong> vytvorené.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      
      <?php else: ?>
        
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          Drink s daným menom <strong>už existuje</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
    <?php endif;
  endif; ?>

  <form action="<?= $_SERVER['PHP_SELF'] ?>" class="form-signin" method="POST">
    <label for="drink_name" class="form-label">Názov</label>
    <div class="input-group mb-3">
      <input <?= isset($drink_id) ? "disabled" : "" ?> value="<?= isset($_POST['drink_name']) ? $_POST['drink_name'] : "" ?>" name="drink_name" required autofocus type="text" class="form-control" placeholder="Názov drinku" aria-label="Názov drinku" aria-describedby="button-addon2">
    </div>

    <label for="drink_volume" class="form-label">Objem</label>
    <div class="input-group mb-3">
      <input name="drink_volume" required value="<?= isset($_POST['drink_volume']) ? $_POST['drink_volume'] : "" ?>" <?= isset($drink_id) ? "disabled" : "" ?> type="number" min="0.00" step="any" class="form-control" placeholder="Objem drinku" aria-label="Objem drinku" aria-describedby="button-addon2">
      <span class="input-group-text">litra</span>
    </div>
    
    <label for="price" class="form-label">Cena</label>
    <div class="input-group mb-3">
      <input name="price" required value="<?= isset($_POST['price']) ? $_POST['price'] : "" ?>" <?= isset($drink_id) ? "disabled" : "" ?> type="number" min="0.00" step="any" class="form-control" placeholder="Cena drinku" aria-label="Cena drinku" aria-describedby="button-addon2">
      <span class="input-group-text">&euro;</span>
    </div>

    <label for="image" class="form-label">Fotka</label>
    <select name="image" class="form-select mb-3" aria-label="Meno fotky drinku">
      <?php foreach($drinks_images as $image): ?>
        <option <?= ($image == @$_POST['image']) ? "selected" : "" ?>><?= $image ?></option>
      <?php endforeach; ?>
    </select>

    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
      <input name="alcoholic" <?= @$_POST['alcoholic'] ? "checked" : "" ?> <?= isset($drink_id) ? "disabled" : "" ?> type="checkbox" class="btn-check" id="alcoholic" autocomplete="off">
      <label for="alcoholic" class="btn btn-outline-warning">Alkoholický</label>

      <input name="inflammatory" <?= @$_POST['inflammatory'] ? "checked" : "" ?> <?= isset($drink_id) ? "disabled" : "" ?> type="checkbox" class="btn-check" id="inflammatory" autocomplete="off">
      <label for="inflammatory" class="btn btn-outline-danger">Zapáľovací</label>

      <input name="deadly" <?= @$_POST['deadly'] ? "checked" : "" ?> <?= isset($drink_id) ? "disabled" : "" ?> type="checkbox" class="btn-check" id="deadly" autocomplete="off">
      <label for="deadly" class="btn btn-outline-dark">Smrtiaci</label>
    </div>

    <?php if (!isset($drink_id)): ?>
      <div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Vytvoriť</button>
          alebo
        <a href="index.php">späť</a>
      <div>
    <?php endif; ?>
  </form>
  
  <!-- ak sme drink úspešne vytvorili, môžeme mu ďalej aj priradiť ingrediencie -->
  <?php if (isset($drink_id)): ?>
    <div style="display: inline-block;" class="alert alert-dark" role="alert">
      <a href="edit_item.php?drink_id=<?= $drink_id ?>" class="alert-link">Pridať ingrediencie a upraviť drink</a>
    </div>
    <br>
    <a href="create_ingredient.php">Vytvoriť ingredienciu</a>
      alebo
    <a href="index.php">domov</a>
  <?php endif; ?>

<?php require "./partials/footer.php"; ?>
