<?php require_once __DIR__ . '/includes/header.php' ?>


  <main class="main">
    <div class="main-container">

      <h1 class="main-heading">Products</h1>
      <section class="breadcrumbs">
        <h2 class="visually-hidden">Navigation</h2>
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-item"><a class="breadcrumbs-link" href="index.html">Main</a></li>
          <li class="breadcrumbs-item"><a class="breadcrumbs-link breadcrumbs-current" href="#">Products</a></li>
        </ul>
      </section>
      <div class="main-content-container">
        <section class="catalog-section">
          <h2 class="visually-hidden">Products</h2>
          <?php require __DIR__ . '/components/displayProduct.php'; ?>
      </div>
    </div>
  </main>

  <?php require __DIR__ . '/includes/footer.php' ?>
