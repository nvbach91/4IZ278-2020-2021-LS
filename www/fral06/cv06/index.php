<?php
include "includes/head.php";
?>

<body>

<!-- Navigation -->
<?php
include "includes/navigation.php"
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Organic shop</h1>

            <!--Categories -->
            <?php
            include "includes/categories.php";
            ?>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            <?php
            require "includes/slides.php";
            ?>

            <div class="row">
                <?php
                require "includes/products.php";
                ?>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<?php
include "includes/footer.php";
?>
<!--Foot -->
<?php
include "includes/foot.php";
?>
