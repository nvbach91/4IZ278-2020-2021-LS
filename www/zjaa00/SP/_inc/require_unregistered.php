<?php

  if (authorize()) {
    header('Location: index.php');
    die();
  }