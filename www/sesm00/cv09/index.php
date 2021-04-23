<?php
if (isset($_COOKIE['user'])) {
    session_start();
}
?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/navigation.php'; ?>


<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Super bazar</h1>

            <?php require 'front/categoryView.php'; ?>

        </div>

        <div class="col-lg-9">

            <?php foreach ($cartMsgs as $msg) : ?>
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endforeach; ?>

            <?php require 'front/sliderView.php'; ?>



            <?php require 'front/productView.php'; ?>


        </div>
    </div>

</div>

<?php include __DIR__ . '/footer.php'; ?>
