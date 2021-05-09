<?php 

    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie('email', '', time());
    setcookie('privilege', '', time());
    session_regenerate_id(true);

    header('Location: index.php');

?>