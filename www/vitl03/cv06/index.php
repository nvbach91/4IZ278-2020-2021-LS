
<?php include __DIR__ . '/includes/header.php' ?>



<body>
    <?php require __DIR__ . '/includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Fruit shop</h1>
                <?php include __DIR__ . '/includes/CategoryDisplay.php' ?>
            </div>
            <!-- /.col-lg-3 -->
            <?php include __DIR__ . '/includes/SlideDisplay.php' ?>
            <div class="row">



                <?php include __DIR__ . '/includes/ProductDisplay.php' ?>




            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
    <?php include __DIR__ . '/includes/footer.php' ?>