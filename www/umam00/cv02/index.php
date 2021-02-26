<?php
/*inclueds */
require './hotreload.php';
require './class/dog.php';
require './util.php';

/*declaration*/

$date = date('d M Y');

        include './includes/header.php'
?>

    <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, a?</h1>
    <h2><?php echo $date; ?></h2>

    <?php include './includes/cities.php';?>
    
    <?php include './includes/dogs.php';?>
    
<?php include './includes/footer.php';