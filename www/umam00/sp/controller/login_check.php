<?php
    if (isset($_POST["btn_login"])) 
    {
        if(isset($_POST["email"]) AND isset($_POST["password"]))
        {
            include('model/login_select.php');
            if($data)
            {
                include('model/user_ver.php');
                $_SESSION["VER"] = $ver;
                include ('reset_page.php');
            }
            else
            {
               $error_msg ="Email or password is incorrect.";
            }

        }
    }
    ?>