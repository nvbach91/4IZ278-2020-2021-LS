<?php
    $date = date('d M Y  H:i:s', time() - 24 * 60 * 60);

?>


<?php include './includes/header.php'; ?>
    <h1>Ahoj svete xytx</h1>
    <h2><?php echo $date; ?></h2>
    <h2><?php echo time(); ?></h2>
    <?php include './includes/cities.php'; ?>
    <?php include './includes/dogs.php'; ?>
<?php include './includes/footer.php'; ?>
