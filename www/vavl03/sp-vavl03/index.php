<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php require __DIR__ . '/components/slideDisplay.php'; ?>

<main class="container-fluid">
    <div class="row">
        <div class="col-lg-xl-12 slide-display">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <img src="<?php echo $slides[0]->img ?>" class="d-block w-100" alt="<?php echo $slides[0]->name ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Buy best graphics cards here on <span class="g">G</span>-SHOP!</h5>
                            <p>
                                <a class="btn btn-lg btn-primary" href="#shop">
                                    Start shopping
                                </a>
                            </p>
                        </div>
                    </div>
                    <?php foreach (array_slice($slides, 1) as $slide) : ?>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="<?php echo $slide->img ?>" class="d-block w-100" alt="<?php echo $slide->name ?>">
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
        </div>
        <div class="col-lg-12">
            <?php require __DIR__ . '/components/categoryDisplay.php'; ?>
        </div>
        <div class="row products-row">
            <div class="col-lg-12 products" id="shop">
                <?php require __DIR__ . '/components/productDisplay.php'; ?>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>