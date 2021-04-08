
<?php require __DIR__ . '/database_connection.php'; ?>
<?php 



    $sql = "SELECT * FROM products WHERE 1;";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();

    $sql = "SELECT * FROM slide";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $slide = $statement->fetchAll();

    $sql = "SELECT * FROM category";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $category = $statement->fetchAll();

    // print_r($results);

?>

<?php require './includes/header.php'?> 
<?php require './includes/navigation.php'?> 


  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">
        <h1 class="my-4">Fruit Shop</h1>   
       
        <?php require './includes/CategoryDisplay.php'?> 

      </div>

      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
      <?php require './includes/SlideDisplay.php'?> 
      <?php require './includes/ProductDisplay.php'?> 


     
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <?php require './includes/footer.php'?> 
