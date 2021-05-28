<?php
session_start();
# session for order
if (!isset($_SESSION['delivery'])) {
    $_SESSION['delivery'] = $_POST['delivery'];
} else {
    $_SESSION['delivery'] = $_POST['delivery'];
}
if (!isset($_SESSION['payment'])) {
    $_SESSION['payment'] = $_POST['payment'];
} else {
    $_SESSION['payment'] = $_POST['payment'];
}
header('Location: ../delivery_details.php');
exit();
