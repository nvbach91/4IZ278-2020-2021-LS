<?php
    session_start();
    $_SESSION["location"] = "blog";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main>
    <div class="container blog text-center">
        <h1>Vítejte na Blogu naší Pivotéky</h1>
        <?php
          if(isset($_SESSION['user']) && $_SESSION['priv']==1){
              echo '<br><a href="./newpost.php"><button type="button" class="btn btn-warning">Napsat příspěvek</button></a>';
          } 
        ?>
        <div class="row mb-2 mezera">
            <?php require __DIR__ . '/comp/blogsdisplay.php'; ?>
        </div>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>