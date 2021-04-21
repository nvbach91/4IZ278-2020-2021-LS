<?php session_start(); ?>
<?php require_once __DIR__ . '/Database.php'; ?>

<?php include __DIR__ . '/includes/header.php' ?>



<body>  
<?php require __DIR__ . '/includes/navigation.php'; ?>

    <!-- Page Content -->
            
    <?php include __DIR__ . '/includes/ProductDisplay.php' ?>


    <!-- /.container -->
    <?php include __DIR__ . '/includes/footer.php' ?>