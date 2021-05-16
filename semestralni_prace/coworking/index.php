<?php require __DIR__ . '/includes/header.php'; ?>

<?php require_once __DIR__ . '/lib/SlidesDB.php'; ?> <?php

                                                      $slidesDB = new SlidesDB();
                                                      $slides = $slidesDB->fetchAll();

                                                      ?>
<main class="container">
  <div id="slider" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php foreach ($slides as $index => $slide) : ?>
        <li data-target="#slider" data-slide-to="<?php echo $index; ?>" class="<?php echo $index == 0 ? 'active' : ''; ?>"></li>
      <?php endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
      <?php foreach ($slides as $index => $slide) : ?>
        <div class="carousel-item slide <?php echo $index == 0 ? 'active' : ''; ?>">
          <img class="d-block img-fluid slide-image" src="<?php echo $slide['img']; ?>" alt="<?php echo $slide['title']; ?>">
        </div>
      <?php endforeach; ?>
    </div>
    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <div class="card">
    <div class="card-body">
      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <div class="card-footer">
      <div class="btn-wrapper text-center justify-content-between">
      <a href="register.php" class="btn btn-light px-5  shadow-sm">Sign up</a>
      <a href="login.php" class="btn btn-light px-5  shadow-sm">Log in</a>
    </div>
  </div>
  </div>

  <?php require __DIR__ . '/includes/footer.php'; ?>