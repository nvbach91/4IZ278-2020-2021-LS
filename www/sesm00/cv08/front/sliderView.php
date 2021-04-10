<?php
require_once __DIR__ . '/../includes/classes/SlidesDB.php';

/*
INSERT INTO `cv06_slides` (`id`, `image`, `title`) VALUES
(NULL, 'imgs/O1RSs.jpg', 'Octavia 1 RS'),
(NULL, 'imgs/E39s.jpg', 'BMW E39'),
(NULL, 'imgs/RS6s.jpg', 'AUDI RS6')
*/

$slidesDB = new SlidesDB();

$slides = $slidesDB->fetchAll();

?>

<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach ($slides as $index => $slide): ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $index; ?>"<?php echo $index == 0 ? " class=\"active\"" : ""; ?>></li>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php foreach ($slides as $index => $slide): ?>
            <div class="carousel-item<?php echo $index == 0 ? " active" : ""; ?>">
                <img class="d-block img-fluid" src="<?php echo BASE_URL . $slide['image']; ?>" alt="<?php echo $slide['title']; ?>">
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