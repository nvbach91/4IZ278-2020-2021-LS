<?php
    session_start();
    $_SESSION["location"] = "beers";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main>
    <div class="container text-center onas">
        <h1>Naše Pivní nabídka</h1>
        <?php
          if(isset($_SESSION['user']) && $_SESSION['priv']==1){
              echo '<br><a href="./newproduct.php"><button type="button" class="btn btn-warning">Nové pivo</button></a><br>';
          } 
        ?>
        <br>
        <?php require __DIR__ . '/comp/categoriesdisplay.php'; ?>
        <div class="row mb-2 mezera">
            <?php require __DIR__ . '/comp/beersdisplay.php'; ?>
        </div>
    </div>

</main>
<?php require __DIR__ . '/incl/footer.php'; ?>