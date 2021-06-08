<?php 
    session_start();
    require __DIR__ . '/incl/auth.php';
    require __DIR__ . '/db/blogsDB.php'; 

    if (!empty($_GET)) {
        $cislo = $_GET["id"];
        $deleteDB = new BlogsDB();
        $deleteblog = $deleteDB->delete([$cislo]);

        Header("Location: blog.php");
    }else{
        Header("Location: index.php");
    }

?>