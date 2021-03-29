<?php
require __DIR__.'/../database/SlideDB.php';
$database = new SlideDB();

$slides =$database->fetchAll();

?>
<div class="slider-container">
<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach ($slides as $slide) : ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $slide['slide_id']; ?>" class="<?php echo $slide['slide_id'] == 1 ? 'active' : '' ?>"></li>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php foreach ($slides as $slide) : ?>
        <div class="carousel-item <?php echo $slide['slide_id'] == 1 ? 'active' : '' ?>">
            <img class="d-block img-fluid" src=" <?php echo $slide['img'] ?> " alt=" <?php echo $slide['title'] ?> ">
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
</div>