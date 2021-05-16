<?php require __DIR__ . '/database_connection.php'; ?>
<?php 



    $sql = "SELECT * FROM product";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();


    // print_r($results);

?>
<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 
        <?php foreach($results as $result): ?>
          <div class="container">
            <div class="row">
              <a href="#"><img  width="100" height="100"  src="<?php echo $result['image']; ?>" alt="<?php echo $result['name']; ?>"></a>         
                  <a href="#"><?php echo $result['name']; ?></a>      
               <?php echo $result['price']; ?>Kč
                <?php echo $result['description']; ?>
            </div>
          </div>
          <?php endforeach; ?>
<?php include './includes/footer.php'?>