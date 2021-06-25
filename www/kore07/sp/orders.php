<?php require_once __DIR__ . '/includes/header.php' ?>


  <main class="main">
    <div class="main-container">

      <h1 class="main-heading">List of orders</h1>
      <div class="main-content-container">
        <section class="">
          <h2 class="visually-hidden">Orders</h2>
          <?php require __DIR__ . '/components/displayOrders.php'; ?>
      </div>
    </div>
  </main>

  <?php require __DIR__ . '/includes/footer.php' ?>
