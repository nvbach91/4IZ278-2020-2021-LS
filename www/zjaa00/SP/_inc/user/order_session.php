<?php
  require_once "../config.php";
  require "../require_user.php";

  session_start();
  if (@$_POST) {
    $_SESSION['order'] = $_POST['order'];
  } else {
    $_SESSION['order'] = "";
  }
