<?php
  require "./partials/header.php";
  require "./_inc/require_admin.php";
?>

<body id="admin_page">
  <h1>Upraviť drink</h1>
<?php  

  if (!empty($_POST['drink_name'])):

    $drink_id = $_GET['drink_id'];
    $drink_name = trim($_POST['drink_name']);
    $drink_volume = round((float) $_POST['drink_volume'], 2);
    $price = round((float) (float) $_POST['price'], 2);
    $image = trim($_POST['image']);
    $alcoholic = isset($_POST['alcoholic']) ? 1 : (int) 0;
    $inflammatory = isset($_POST['inflammatory']) ? 1 : (int) 0;
    $deadly = isset($_POST['deadly']) ? 1 : (int) 0;
    
    $select = $connect->prepare("
      SELECT * from drinks WHERE name = :drink_name AND drink_id != :drink_id;
    ");
    $select->execute([
      ":drink_name" => $drink_name,
      ":drink_id" => $drink_id,
    ]);
    $exists = $select->fetchColumn();

    //ak už drink s daným menom existuje, vypíšeme chybovú hlášku
    if (@!$exists):
      $update = $connect->prepare("
        UPDATE drinks SET
        name = :drink_name,
        volume = :drink_volume,
        price = :price,
        image = :image,
        alcoholic = :alcoholic,
        inflammatory = :inflammatory,
        deadly = :deadly
        WHERE drink_id = :drink_id;
      ");
      $update->execute([
        ":drink_id" => $drink_id,
        ":drink_name" => $drink_name,
        ":drink_volume" => $drink_volume,
        ":price" => $price,
        ":image" => $image,
        ":alcoholic" => $alcoholic,
        ":inflammatory" => $inflammatory,
        ":deadly" => $deadly,
      ]);

      @$new_ingr_ids = $_POST['new_ingr_ids'];
      @$old_ingr_ids = $_POST['old_ingr_ids'];
      @$new_ingr_volumes = $_POST['new_ingr_volumes'];

      if (!empty($_POST['new_ingr_ids'])) {
        for ($i=0; $i < sizeof($new_ingr_ids); $i++) {
          $update = $connect->prepare("
            UPDATE drinks_ingredients SET
            drink_id = :drink_id,
            ingr_id = :new_ingr_id,
            volume = :new_ingr_volume
            WHERE ingr_id = :old_ingr_id AND drink_id = :drink_id;
          ");
          $update->execute([
            ":drink_id" => $drink_id,
            ":new_ingr_id" => $new_ingr_ids[$i],
            ":new_ingr_volume" => $new_ingr_volumes[$i],
            ":old_ingr_id" => $old_ingr_ids[$i],
          ]);
        }
      }
?>

      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Úspešne</strong> upravené.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

    <?php else: ?>

      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Drink s daným menom <strong>už existuje</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

    <?php endif; ?>
  <?php endif;

  $select = $connect->prepare("
  SELECT drink_id, name as drink_name, volume as drink_volume, price, image, alcoholic, inflammatory, deadly, available
  FROM drinks WHERE drink_id = :drink_id;"
  );
  $select->execute(['drink_id' => $_GET['drink_id']]);
  @$drink = $select->fetchAll()[0];
  
  $select = $connect->prepare("
    SELECT
      ingredients.ingr_id as ingr_id,
      drinks_ingredients.volume as ingr_volume,
      CONCAT_WS(' ',
          IF(percentage, CONCAT(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from percentage)), '%'), null),
          ingredients.name) as ingr_name
    FROM drinks_ingredients
    JOIN ingredients
      ON ingredients.ingr_id = drinks_ingredients.ingr_id
    JOIN drinks
      ON drinks.drink_id = drinks_ingredients.drink_id
    WHERE drinks_ingredients.drink_id = :drink_id;
  ");
  $select->execute(['drink_id' => $_GET['drink_id']]);
  $drink_ingredients = $select->fetchAll();

  $select = $connect->prepare("
    SELECT
      ingredients.ingr_id as ingr_id,
      CONCAT_WS(' ',
          IF(percentage, CONCAT(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from percentage)), '%'), null),
          ingredients.name) as ingr_name
    FROM ingredients
    JOIN drinks_ingredients
      ON ingredients.ingr_id = drinks_ingredients.ingr_id
    JOIN drinks
      ON drinks.drink_id = drinks_ingredients.drink_id
    GROUP BY ingr_id, ingr_name
    ORDER BY ingredients.name;
  ");
  $select->execute();
  $ingredients = $select->fetchAll();

  $drinks_images = array_slice(scandir("./img/items/"), 2);

  ?>

    <form action="<?= $_SERVER['PHP_SELF'] ?>?drink_id=<?= $_GET['drink_id'] ?>" class="form-signin" method="POST">

      <label for="drink_name" class="form-label">Názov</label>
      <div class="input-group mb-3">
        <input name="drink_name" required autofocus value="<?= $drink['drink_name']; ?>" type="text" class="form-control" placeholder="Názov drinku" aria-label="Názov drinku" aria-describedby="button-addon2">
      </div>

      <label for="drink_volume" class="form-label">Objem</label>
      <div class="input-group mb-3">
        <input name="drink_volume" required value="<?= $drink['drink_volume']; ?>" type="number" min="0.00" step="any" class="form-control" placeholder="Objem drinku" aria-label="Objem drinku" aria-describedby="button-addon2">
        <span class="input-group-text">litra</span>
      </div>
      
      <label for="price" class="form-label">Cena</label>
      <div class="input-group mb-3">
        <input name="price" required value="<?= $drink['price']; ?>" type="number" min="0.00" step="any" class="form-control" placeholder="Cena drinku" aria-label="Cena drinku" aria-describedby="button-addon2">
        <span class="input-group-text">&euro;</span>
      </div>

      <label for="image" class="form-label">Fotka</label>
      <select name="image" class="form-select mb-3" aria-label="Meno fotky drinku">
        <?php foreach($drinks_images as $image): ?>
          <option <?= ($drink['image'] == $image) ? "selected" : "" ?>><?= $image ?></option>
        <?php endforeach; ?>
      </select>

      <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <input name="alcoholic" <?= $drink['alcoholic'] ? "checked" : "" ?> type="checkbox" class="btn-check" id="alcoholic" autocomplete="off">
        <label for="alcoholic" class="btn btn-outline-warning">Alkoholický</label>

        <input name="inflammatory" <?= $drink['inflammatory'] ? "checked" : "" ?> type="checkbox" class="btn-check" id="inflammatory" autocomplete="off">
        <label for="inflammatory" class="btn btn-outline-danger">Zapáľovací</label>

        <input name="deadly" <?= $drink['deadly'] ? "checked" : "" ?> type="checkbox" class="btn-check" id="deadly" autocomplete="off">
        <label for="deadly" class="btn btn-outline-dark">Smrtiaci</label>
      </div>
      

      <h3>Ingrediencie</h3>
      <?php if($drink_ingredients): ?>
        <?php foreach($drink_ingredients as $ingredient): ?>
          <div class="input-group mb-3">
            <select name="new_ingr_ids[]" class="form-select" aria-label="Default select example">
              <?php foreach($ingredients as $item): ?>
                <option value="<?= $item['ingr_id'] ?>" <?= $ingredient['ingr_id'] == $item['ingr_id'] ? "selected" : "" ?>><?= $item['ingr_name'] ?></option>
              <?php endforeach; ?>
            </select>
            <input required name="new_ingr_volumes[]" min="0.00" value="<?= $ingredient['ingr_volume'] ?>" step="any" type="number" class="form-control" placeholder="Objem ingrediencie" aria-label="Objem ingrediencie" aria-describedby="button-addon2">
            <span class="input-group-text">litra</span>
            <input required name="old_ingr_ids[]" type="hidden" value="<?= $ingredient['ingr_id'] ?>">
            <a class="btn btn-outline-danger" href="./_inc/admin/delete_ingredient.php?drink_id=<?= $_GET['drink_id'] ?>&ingr_id=<?= $ingredient['ingr_id'] ?>">Vymazať</a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="no_results">Žiadne výsledky</div>
      <?php endif; ?>

      <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Uložiť</button> alebo <a href="index.php">späť</a>
    </form>
      
    <h1>Pridať ingredienciu</h1>
    <form action="./_inc/admin/assign_ingredient.php?drink_id=<?= $_GET['drink_id'] ?>" class="form-signin" method="POST">
      <div class="input-group mb-3">
        <select name="ingr_id" class="form-select" aria-label="Default select example">
          <?php foreach($ingredients as $item): ?>
            <option value="<?= $item['ingr_id'] ?>"><?= $item['ingr_name'] ?></option>
          <?php endforeach; ?>
        </select>
        <input required name="ingr_volume" min="0.00" value="0.00" step="any" type="number" class="form-control" placeholder="Objem ingrediencie" aria-label="Objem ingrediencie" aria-describedby="button-addon2">
        <span class="input-group-text">litra</span>
        <button class="btn btn-outline-success" type="submit" id="button-addon2">Pridať</button>
      </div>
    </form>

<?php require "./partials/footer.php"; ?>
