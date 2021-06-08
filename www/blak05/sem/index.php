<?php
    session_start();
    $_SESSION["location"] = "index";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main>
    <?php require __DIR__ . '/incl/carousel.php'; ?>
    <?php require __DIR__ . '/incl/types.php'; ?>
    <?php require __DIR__ . '/incl/brands.php'; ?>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>

