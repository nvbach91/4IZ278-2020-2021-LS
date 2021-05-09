<?php

  session_start();
  if (@$_POST) {
    $_SESSION['order'] = $_POST['order'];
  } else {
    $_SESSION['order'] = "";
  }
