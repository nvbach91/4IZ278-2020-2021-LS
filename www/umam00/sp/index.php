<?php
    session_start();
    if(isset($_SESSION["VER"]))
    {
        include ('model/pdo.php');
        include ('model/login_ver.php');
        include ('model/fce.php');

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
