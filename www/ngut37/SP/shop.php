<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/navbar.php'; ?>
<?php require __DIR__ . '/db/connection.php'; ?>
<?php 

  $nItemsInDatabase = $pdo->query("SELECT COUNT(id) FROM ramen;")->fetchColumn();

  $sql = "SELECT * FROM ramen";
  $statement = $pdo->prepare($sql);
  $statement->execute();

  $results = $statement->fetchAll();

?>

<div>Number of items in catalog: <?php echo $nItemsInDatabase; ?></div>
<?php foreach($results as $ramen): ?>
<div>
  <img src="<?php echo $ramen['image']; ?>">
  <div class="name"><?php echo $ramen['name']; ?></div>
  <div class="price"><?php echo $ramen['price']; ?></div>
  <div class="description"><?php echo $ramen['description']; ?></div>
</div>
<?php endforeach; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>