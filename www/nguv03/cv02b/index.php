
<?php

$now = time();
$date = date('Y/m/d H:i:s', time() + 24 * 60 * 60);

?>


<?php include './includes/header.php'; ?>
    <h1>Hello dolly x!</h1>
    <h2>Blabla! 123</h2>
    <h3><?php echo $now; ?></h3>
    <h3><?php echo $date; ?></h3>
    <?php include './includes/cities-array.php'; ?>
    <?php include './includes/cities-class.php'; ?>
<?php include './includes/footer.php'; ?>