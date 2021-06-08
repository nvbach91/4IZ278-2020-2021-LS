<?php 
    session_start();
    require __DIR__ . '/incl/auth.php';
    require __DIR__ . '/db/beersDB.php'; 

    if (!empty($_GET)) {
        $cislo = $_GET["id"];
        $deleteDB = new BeersDB();
        $deletebeer = $deleteDB->delete([$cislo]);

        Header("Location: beers.php");
    }else{
        Header("Location: index.php");
    }

?>