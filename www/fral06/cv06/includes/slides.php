<?php

require __DIR__ . '/../model/SlidesDB.php';

$slidesDB = new SlidesDB();
$data = $slidesDB->fetch();
?>
<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach($data as $index=>$slide): ?>
            <li data-target="#slider" data-slide-to="<?php echo $index; ?>" class="<?php echo $index == 0 ? 'active' : ''; ?>"></li>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php foreach ($data as $index=>$slide): ?>
        <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
            <img class="d-block img-fluid" src="public/img/<?php echo $slide['img']?>" alt="<?php echo $slide['title']?>">
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
