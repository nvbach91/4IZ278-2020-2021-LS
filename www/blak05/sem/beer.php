<?php
    session_start();
    $_SESSION["location"] = "beers";
?>
<?php require __DIR__ . '/db/beersDB.php' ?>
<?php
    $id = $_GET['id'];

    $beersDB = new BeersDB();
    $beer = $beersDB->fetchBeer($id);
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main>
    <div class="container blog text-center">
        <h1><?php echo $beer['brand'] ?> - <?php echo $beer['name'] ?></h1>
        <p>Na skladu nám zbývá <?php echo $beer['stock'] ?> kusů!</p>
        <?php
          if(isset($_SESSION['user']) && $_SESSION['priv']==1){
              echo '<a href="editbeer.php?id='. $_GET["id"] . '"><button type="button" class="btn btn-warning">Editovat pivo</button></a>
              <a href="deletebeer.php?id='. $_GET["id"] . '"><button type="button" class="btn btn-warning">Smazat pivo</button></a><br><br>';
          } 
        ?>
        <p>
            <?php echo $beer['description'] ?><br>
            <img class="pt-3" height="400px" src="<?php echo $beer['image']?>">
        </p>
        <?php if($beer['stock']<1):?>
            <button type="button" class="btn btn-dark mb-2" disabled>Vyprodáno</button></a>
            <?php else:?>
                <a href="buy.php?id=<?php echo $beer['id_product']; ?>"><button type="button" class="btn btn-dark mb-2"><?php echo $beer['price']; ?> Kč</button></a>
            <?php endif ?>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>
