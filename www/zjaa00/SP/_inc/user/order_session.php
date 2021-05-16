<?php
  require_once "../config.php";

  if (@$_POST) {
    $_SESSION['order'] = $_POST['order'];
  } else {
    $_SESSION['order'] = "";
  }
