<?php
//head
include "includes/head.php";
//Navigation
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
                <div class="col-sm-12 mb-4"><a class="btn " href="create-item.php">Add product</a></div>
                <?php
                require "includes/products.php";
                require "includes/pagination.php";
                ?>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php
//Footer
include "includes/footer.php";
//Foot
include "includes/foot.php";
?>
