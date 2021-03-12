<?php 
    $date = date('l');
?>


<?php include './includes/header.php' ?>

    <h1>Hlavička</h1>
    <h2><?php echo $date?></h2>
    <?php include './includes/cities.php' ?>
    <?php include './includes/dogs.php' ?>

    <?php include './includes/footer.php' ?>