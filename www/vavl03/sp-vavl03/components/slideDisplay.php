<?php require __DIR__ . '/../db/SlideDB.php'; ?>
<?php

$slidesDB = new SlideDB();
$slides = $slidesDB->fetchAll();
?>

<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($slides as $index => $slide) : ?>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index == 0 ? 'active' : ''; ?>"></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($slides as $index => $slide) : ?>
            <div class="carousel-item  <?php echo $index == 0 ? 'active' : ''; ?>" data-bs-interval="5000">
                <img src="<?php echo $slide['img'] ?>" class="d-block w-100" alt="<?php echo $slide['name'] ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Buy best graphics cards here on <span class="g">G</span>-SHOP!</h5>
                    <p>
                        <a class="btn btn-lg btn-primary" href="#shop">
                            Start shopping
                        </a>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>