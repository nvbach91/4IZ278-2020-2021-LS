<?php
    session_start();
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
            include('logout.php');
        }
    }
    else
    {
        include('view/login.php');
        include('view/bottom.php');
    }
?>
