<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>cv04</title>

  <!-- icon and fonts -->
  <link rel="icon" href="../img/donut.png" />
  <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" />

  <link rel="stylesheet" href="../css/style.css">

  <!--[if lt IE 9]>
    <!script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
    </!script> <![endif]-->

</head>

<body>
  <nav>
    <a href="../index.php">Home</a>
    <a href="../registration.php">Registration</a>
    <a href="../login.php">Login</a>
  </nav>

<?php

include "../_inc/functions.php";


$users = getUsers('../users.db');

foreach ($users as $user => $data) : ?>
  <div class="profile-card">
    <div style="background-image: url('../img/homer.png');"></div>
    <div class="info">
      <h1>
        <?= $users[$user]["name"] ?>
      </h1>
      <small><?= $user ?></small>
      <p>
        Cupcake ipsum dolor sit amet tart muffin cake. I love dessert marzipan I love muffin cheesecake dragée. Fruitcake jelly-o biscuit.
      </p>
    </div>
  </div>

<?php endforeach; ?>

</body>

</html>