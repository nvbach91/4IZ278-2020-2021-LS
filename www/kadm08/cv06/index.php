<?php require __DIR__ . '/includes/header.php'; ?>

<main class="container">
    <div class="row">
        <div class="col-lg-3">
            <?php require __DIR__ . '/display/CategoryDisplay.php'; ?>
        </div>
        <div class="col-lg-9">
            <?php require __DIR__ . '/display/SlideDisplay.php'; ?>
            <?php require __DIR__ . '/display/ProductDisplay.php'; ?>
        </div>
    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>