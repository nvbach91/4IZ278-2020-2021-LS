<?php
    session_start();
    $_SESSION["location"] = "brew";
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main>
    <?php if(!empty($_GET['id'])): ?>
        <?php require __DIR__ . '/db/beersDB.php' ?>
        <?php $id = $_GET['id'];
            $brewDB = new BeersDB();
            $brew = $brewDB->fetchBrew($id);
        ?>
        <div class="container blog text-center">
        <h1><?php echo $brew['brand'] ?> - <?php echo $brew['name'] ?></h1>
        <p>Na skladu nám zbývá <?php echo $brew['stock'] ?> kusů!</p>
        <?php
          if(isset($_SESSION['user']) && $_SESSION['priv']==1){
              echo '<a href="editbeer.php?id='. $_GET["id"] . '"><button type="button" class="btn btn-warning">Editovat nástroj</button></a>
              <a href="deletebeer.php?id='. $_GET["id"] . '"><button type="button" class="btn btn-warning">Smazat nástroj</button></a><br><br>';
          } 
        ?>
        <p>
            <?php echo $brew['description'] ?><br>
            <img class="pt-3" height="400px" src="<?php echo $brew['image']?>">
        </p>
        <?php if($brew['stock']<1):?>
            <button type="button" class="btn btn-dark mb-2" disabled>Vyprodáno</button></a>
            <?php else:?>
                <a href="buy.php?id=<?php echo $brew['id_product']; ?>"><button type="button" class="btn btn-dark mb-2"><?php echo $brew['price']; ?> Kč</button></a>
            <?php endif ?>
        </div>
    <?php else: ?>
    <div class="container text-center onas">
        <h1>Domácí Vaření Piva</h1>
        <?php
          if(isset($_SESSION['user']) && $_SESSION['priv']==1){
              echo '<br><a href="./newproduct.php"><button type="button" class="btn btn-warning">Nový produkt</button></a>';
          } 
        ?>
        <br>
        <div class="row mb-2 mezera">
            <?php require __DIR__ . '/comp/brewdisplay.php'; ?>
        </div>
    </div>
    <?php endif ?>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>