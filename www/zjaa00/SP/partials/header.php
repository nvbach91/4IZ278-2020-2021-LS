<?php
  require_once './_inc/config.php';
?>
<!DOCTYPE html>
<html lang="sk">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>NEBRA&reg; &#124; Bar v Košiciach a v Bratislave, ktorý si tvorí svoje vlastné drinky</title>
  <meta name="description" content="Sme Nebra. Bar v Košiciach a v Bratislave, ktorý si tvorí svoje vlastné drinky. Vďaka našej širokej ponuke nápojov a stránke si u nás určite nájde každý niečo, čo si zamiluje."/>

  <!-- icon and fonts -->
  <link rel="icon" href="img/logo.png" />
  <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  
  <?php if (authorize(2)): ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <?php endif; ?>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css">

  <!--[if lt IE 9]>
    <!script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
    </!script> <![endif]-->

</head>