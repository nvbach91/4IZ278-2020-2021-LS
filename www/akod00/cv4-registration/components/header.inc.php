<?php require_once __DIR__ . "./../Constants.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Enforces legacy IE browsers to display content in the highest mode available -->
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap style library reference -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
  <!-- Icons style library reference -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <!-- Custom style library reference -->
  <link rel="stylesheet" href="../css/style.css">

  <title>
    <?php
      echo Constants::title;

      if (isset($pageTitle) && $pageTitle) {
          echo ": " . $pageTitle;
      }
    ?>
  </title>
</head>
<body>

<?php require __DIR__ . "./nav.inc.php"?>

<main class="container mt-2 mb-2 card p-5">
