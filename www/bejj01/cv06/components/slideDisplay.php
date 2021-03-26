<?php
    require __DIR__ . '/../database/slidesDB.php';

    $slidesDB = new SlidesDB();

    /*$slides = [
        ['img' => 'https://cdn.elearningindustry.com/wp-content/uploads/2016/05/top-10-books-every-college-student-read-1024x640.jpeg', 'title' => '2 knihy za cenu jedné!'],
        ['img' => 'https://nakupujvcine.cz/wp-content/uploads/2019/05/free-shipping.jpg', 'title' => 'Nad 1000 Kč, doprava zdarma!'],
        ['img' => 'https://i2.wp.com/www.tor.com/wp-content/uploads/2019/01/LOTR-Ballantine.png?fit=770%2C+9999&crop=0%2C0%2C100%2C420px&ssl=1', 'title' => 'Triologie Pána Prstenů pouze za 899 Kč']
    ];

    foreach($slides as $newSlide) {
        $slidesDB->create($newSlide);
    }
    */

    $slides = $slidesDB->fetchAll();


?>

<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach($slides as $index=>$slide): ?>
            <li data-target="#carouselExampleIndicators"
                data-slide-to="<?php echo $index; ?>"
                class="<?php echo $index == 0 ? 'active' : ''; ?>"></li>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php foreach($slides as $index=>$slide): ?>
            <div class="carousel-item slide <?php echo $index == 0 ? 'active' : ''; ?>">
                <img class="d-block img-fluid" src="<?php echo $slide['img']; ?>" alt="<?php echo $slide['title']; ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="text-light"><?php echo $slide['title']; ?></h5>
                </div>
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