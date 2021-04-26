<?php

require_once "./SlidesDB.php";

$slides_db = new SlidesDB();

/* $slides = [
  ['title' => 'Tommy Atkins', 'img' => 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'],
  ['title' => 'Ataulfo', 'img' => 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'],
  ['title' => 'Kent', 'img' => 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'],
];


foreach($slides as $slide) {
  $slides_db->create($slide);
} */

$slides = $slides_db->fetchAll();

?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">

    <?php foreach($slides as $index => $slide): ?>
      <div class="carousel-item <?= $index == 0 ? "active" : "" ?>">
        <img src="<?= $slide['img'] ?>" class="d-block w-100" alt="<?= $slide['title'] ?>">
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