<?php
$_SESSION["ID_PROJ"] = null;
$_SESSION["ID_NOTE"] = null;
if(isset($exit_page))
{

    if ($_SERVER['SERVER_NAME'] !="localhost")
    {
        print '<script type="text/javascript">window.location.replace("/'.$exit_page.'");</script>';
    }
    else
    {
        print '<script type="text/javascript">window.location.replace(".'.$exit_page.'");</script>';
    }
    exit();
}
else
{

    if ($_SERVER['SERVER_NAME'] !="localhost")
    {
        print '<script type="text/javascript">window.location.replace("/");</script>';
    }
    else
    {
        print '<script type="text/javascript">window.location.replace(".");</script>';
    }
    exit();
}
?>