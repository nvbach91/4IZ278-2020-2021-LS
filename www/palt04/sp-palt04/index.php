<?php 
session_start();
require_once __DIR__ . '/config/config.php';
include __DIR__ . '/partials/header.php';
include __DIR__ . '/navigation.php'; 
?>
<div class="container">

    <div class="row">

      <div class="col-lg-3 my-4">

        <?php require 'frontend/categoryView.php'; ?>
    
      </div>

      <div class="col-lg-9">

            <?php require 'frontend/sliderView.php'; ?>

            <div class="row">

                <?php require 'frontend/productView.php'; ?>

            </div>
        </div>
    </div>

</div>
<footer class="py-5 bg-dark">
    <div class="container containter-fluid">
      <p class="m-0 text-center text-white">Copyright &copy; NBA 2020</p>
    </div>
    <!-- /.container -->
  </footer>
<?php
include __DIR__ . '/partials/footer.php';
?>