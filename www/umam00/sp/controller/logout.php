<?php
session_start();
$_SESSION["VER"] = null;
$_SESSION["ID"] = null;
session_destroy();

header("Location: ../index.php");
exit();
?>