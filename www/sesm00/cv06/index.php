<?php require_once __DIR__ . '/includes/utils/baseHelper.php'; ?>
<?php require_once __DIR__ . '/config/config.php'; ?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/navigation.php'; ?>


<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Super bazar</h1>
            <?php require 'front/categoryView.php'; ?>

        </div>

        <div class="col-lg-9">

            <?php require 'front/sliderView.php'; ?>

            <div class="row">

                <?php require 'front/productView.php'; ?>

            </div>
        </div>
    </div>

</div>

<?php include 'footer.php'; ?>
