<?php 

    if (session_id() == '') {
        session_start();
    }
    session_unset();
    session_destroy();
    session_write_close();
    setcookie('email', '', time());
    session_regenerate_id(true);

    header('Location: index.php');

?>