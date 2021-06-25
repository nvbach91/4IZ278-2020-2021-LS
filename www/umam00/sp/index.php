<?php
    session_start();
    include ('model/fb_conf.php');
    include ('controller/fce.php');
    if(isset($_SESSION["VER"]))
    {
        include ('model/pdo.php');
        include ('model/login_ver.php');

        if($data)
        {
            include('view/main.php');
            include('view/bottom.php');
        }
        else
        {
            include('controller/logout.php');
        }
    }
    else
    {
        include('view/login.php');
        include('view/bottom.php');
    }
?>
