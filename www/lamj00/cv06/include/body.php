<?php
$DIR = substr_replace(__DIR__,"",-8);
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Game Shop</h1>
            <?php require($DIR. '\components\CategoryDisplay.php');?>
        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">
            <?php require($DIR.'\components\SlideDisplay.php'); ?>
            <?php require $DIR.'\components\ProductDisplay.php'; ?>
        <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
