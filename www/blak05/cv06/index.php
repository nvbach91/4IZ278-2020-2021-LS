<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?php require __DIR__ . '/comp/categorydisplay.php'; ?>
            </div>
            <div class="col-lg-9">
                <?php require __DIR__ . '/comp/sliderdisplay.php'; ?>
                <div class="row">
                    <?php require __DIR__ . '/comp/productdisplay.php'; ?>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/incl/footer.php'; ?>
