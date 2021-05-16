<?php include ('model/add_note.php')?>
<!DOCTYPE html>
<html lang="en">
<?php include ('view/head.php') ?>
<body class="main">
    <div class="side-bar">
        <div class="logo">
            <?php include('view/logo_black.php') ?>
        </div>
        <div class="side-menu">
            <ul>
                <li><a href="#">notes</a></li>
                <li><a href="#">project</a></li>
                <li><a href="#">settings</a></li>
            </ul>
        </div>
        <form action="controller/logout.php" metod="post">
        <button name="logout" class="logout">Logout</button>
        </form>
    </div>
    <?php 
    if(isset($_GET["add"]))
    {
        if($_GET["add"] == "note")
        {
            include ('note_form.php');
        }
    }
    else
    {
    include ('view/notes_list.php'); 
    }
    ?>



