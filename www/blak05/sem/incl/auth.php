<?php
    $haveRights = (isset($_SESSION['user']) && $_SESSION['priv']==1);
    if(!$haveRights){
        header('Location: ./login.php');
    }
?>