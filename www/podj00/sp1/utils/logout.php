<?php
session_start();

if (isset($_SESSION['fb_access_token'])) {
    unset($_SESSION['fb_access_token']);
}
if (isset($_SESSION['logged_user'])) {
    unset($_SESSION['logged_user']);
}

if (isset($_SESSION['user_facebook_id'])) {
    unset($_SESSION['user_facebook_id']);
}
header('Location: ../index');
exit();
?>