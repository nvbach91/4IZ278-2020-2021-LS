<?php 

if(isset($_GET["projects"]) or isset($_GET["shared_projects"]))
{
    $location="projects";
}
elseif(isset($_GET["settings"]))
{
    $location="settings";
}
else
{
    $location="notes";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/src/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/src/css/main.css?v=10" rel="stylesheet">
    <link href="assets/src/css/content.css" rel="stylesheet">

    <!-----------fonts / icons ---------->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <!---------------------------------->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/8gxgmy973um1c2ei41zy8lf5j7k5gb4t1euobmb786ato0py/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <title>Noter...</title>


</head>