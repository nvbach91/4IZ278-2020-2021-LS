<?php require __DIR__ . '/../SlidesDB.php'; ?>
<?php
$slidesDB = new SlidesDB();
$slides = $slidesDB->fetchAll();
?>


<div class="col-lg-9">

    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">

            <div class="carousel-item active">
                <img class="d-block container-fluid" src="https://lh3.googleusercontent.com/proxy/BvWSgHvWh32pPqurW32_5e9H_YgGAis1oHdJti5GSZ5wjSqA9cpjXMHoj5mpQ2TYFlUrW0f4qzR_RI65zaTkT92g4D8te13FMvxl-d1jwcKoUNdbLc2TDAr0mqBC-nkLNQ" width="900" height="400" alt="Active">
            </div>

            <?php foreach ($slides as $slide) : ?>
                <div class="carousel-item">
                    <img class="d-block container-fluid" src="<?php echo $slide['img']; ?>" width="900" height="400" alt="<?php echo $slide['title']; ?>">
                </div>
            <?php endforeach; ?>



        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>