
<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img class="d-block img-fluid" src="<?php echo getProtocol() . $_SERVER['HTTP_HOST'] . getBaseUrl(); ?>/img/d1.jpg" alt="d1">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid" src="<?php echo getProtocol() . $_SERVER['HTTP_HOST'] . getBaseUrl(); ?>/img/blik.jpg" alt="blikani">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid" src="<?php echo getProtocol() . $_SERVER['HTTP_HOST'] . getBaseUrl(); ?>/img/rozloha.jpg" alt="rozloha">
        </div>
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