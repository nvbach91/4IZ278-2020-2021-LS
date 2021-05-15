<?php
  require_once "./_inc/config.php";
  require "./_inc/require_admin.php";
  require "./partials/header.php";
?>

<body id="admin_page">
  <h1>Ingrediencie</h1>
  <a href="index.php" class="btn btn-outline-primary mb-4">späť</a>

<?php
  
  if (isset($_POST)) {

    $ingr_id = $_POST['ingr_id'];
    $ingr_name = trim($_POST['ingr_name']);
    $percentage = @$_POST['percentage'] ? round((float) $_POST['percentage'], 2) : null;

    //pokiaľ sme ingredienciu upravovali
    if(isset($_POST['edit'])) {
      $update = $connect->prepare('
        UPDATE ingredients SET
        ingr_id = :ingr_id,
        name = :ingr_name,
        percentage = :percentage
        WHERE ingr_id = :ingr_id;
      ');
      $update->execute([
        ":ingr_id" => $ingr_id,
        ":ingr_name" => $ingr_name,
        ":percentage" => $percentage,
      ]);
    }
    
    //pokiaľ sme ingredienciu mazali
    if(isset($_POST['delete'])) {
      $update = $connect->prepare('
        DELETE FROM ingredients
        WHERE ingr_id = :ingr_id;
      ');
      $update->execute([
        ":ingr_id" => $ingr_id,
      ]);
    }
  }
  
  //výpis všetkých ingrediencií
  $stmt = $connect->prepare('
    SELECT ingr_id, name as ingr_name, percentage
    FROM ingredients
    ORDER BY ingr_name asc;
  ');
  $stmt->execute();
  $ingredients = $stmt->fetchAll(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC);
  
  ?>
      
<?php foreach($ingredients as $id => $ingredient): ?>

  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="input-group mb-3">
      <input required name="ingr_id" type="hidden" value="<?= $id ?>">
      <input required name="ingr_name" value="<?= $ingredient['ingr_name'] ?>" type="text" class="form-control" placeholder="Názov ingrediencie" aria-label="Názov ingrediencie" aria-describedby="button-addon2">
      <input name="percentage" min="0.00" max="100.00" value="<?= $ingredient['percentage'] ?>" step="any" type="number" class="form-control" placeholder="Percento alkoholu ingrediencie" aria-label="Percento alkoholu ingrediencie" aria-describedby="button-addon2">
      <span class="input-group-text">&percnt;</span>
      <input required name="edit" value="Upraviť" type="submit" class="btn btn-warning" aria-label="Upraviť" aria-describedby="button-addon2">
      <input required name="delete" value="Vymazať" type="submit" class="btn btn-outline-danger" aria-label="Vymazať" aria-describedby="button-addon2">
    </div>
  </form>

<?php endforeach; ?>

<?php require "./partials/footer.php"; ?>