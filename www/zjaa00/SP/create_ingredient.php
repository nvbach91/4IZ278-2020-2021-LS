<?php
  require_once "./_inc/config.php";
  require "./_inc/require_admin.php";
  require "./partials/header.php";
?>

<body id="admin_page">

<h1>Vytvoriť ingredienciu</h1>

<?php
  if (!empty($_POST)):

    $ingr_name = trim($_POST['ingr_name']);
    $percentage = @$_POST['percentage'] ? round((float) $_POST['percentage'], 2) : null;
    
    $sql = "SELECT * from ingredients WHERE name = :ingr_name";

    $execute[":ingr_name"] = $ingr_name;
    if ($percentage) {
      $sql .= "
      AND percentage = :percentage";
      $execute[":percentage"] = $percentage;
    }
    
    $stmt = $connect->prepare($sql);
    $stmt->execute($execute);
    $exists = $stmt->fetchColumn();
    
    //ak už existuje ingrediencia s daným menom a percentom alkoholu, tak vyhodíme chybovú hlášku, ak nie tak hlášku úspechu
    if (!$exists):  
      
      $insert = $connect->prepare("
        INSERT INTO ingredients (name, percentage)
        VALUES (:ingr_name, :percentage);
      ");
      $insert->execute([
        ":ingr_name" => $ingr_name,
        ":percentage" => $percentage,
      ]);
      
      //odchytíme si ID novovytvorenej ingrediencie
      $ingr_id = $connect->lastInsertId();
    ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Úspešne</strong> vytvorené.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      
      <?php else: ?>
        
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          Ingrediencia s daným menom <strong>už existuje</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
    <?php endif;
  endif; ?>

  <form action="<?= $_SERVER['PHP_SELF'] ?>" class="form-signin" method="POST">
    <label for="ingr_name" class="form-label">Názov*</label>
    <div class="input-group mb-3">
      <input <?= isset($ingr_id) ? "disabled" : "" ?> value="<?= isset($_POST['ingr_name']) ? $_POST['ingr_name'] : "" ?>" name="ingr_name" required autofocus type="text" class="form-control" placeholder="Názov ingrediencie" aria-label="Názov ingrediencie" aria-describedby="button-addon2">
    </div>

    <label for="percentage" class="form-label">Percento</label>
    <div class="input-group mb-3">
      <input name="percentage" value="<?= isset($_POST['percentage']) ? $_POST['percentage'] : "" ?>" <?= isset($ingr_id) ? "disabled" : "" ?> type="number" min="0.00" max="100.00" step="any" class="form-control" placeholder="Percento alkoholu ingrediencie" aria-label="Percento alkoholu ingrediencie" aria-describedby="button-addon2">
      <span class="input-group-text">&percnt;</span>
    </div>
    
    <?php if (!isset($ingr_id)): ?>
      <div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Vytvoriť</button>
          alebo
        <a href="index.php">späť</a>
      <div>
    <?php endif; ?>
  </form>
  
  <?php if (isset($ingr_id)): ?>
    <div style="display: inline-block;" class="alert alert-dark" role="alert">
      <a href="create_ingredient.php" class="alert-link">Vytvoriť ďalšiu ingredienciu</a>
    </div>
      alebo
    <a href="index.php">späť</a>
  <?php endif; ?>

<?php require "./partials/footer.php"; ?>