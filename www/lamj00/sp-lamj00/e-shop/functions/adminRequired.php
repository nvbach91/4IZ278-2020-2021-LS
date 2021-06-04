<?php
require_once "db/Profile.php";
$profile = new Profile($_SESSION["user_id"]);
$privilege = $profile->getPrivileges();
if ($privilege != 3) {
    header("location:noPermission.php");
}

