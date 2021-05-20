<?php
if (session_status() != 2) {
    session_start();
}
if (time() > $_SESSION['access_token_expiries']) {
    unset($_SESSION['access_token_expiries']);
}
// if user is not logged in, redirect to home page
if (!isset($_SESSION['fb_access_token']) || !isset($_SESSION['access_token_expiries'])) {
    header('Location: /~vavl03/sp-vavl03/signin.php');
    exit();
}
