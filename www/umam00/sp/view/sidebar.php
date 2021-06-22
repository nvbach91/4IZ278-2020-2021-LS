<div class="side-bar smooth">
        <div class="logo">
            <?php include('view/logo_black.php') ?>
        </div>
        <div class="side-menu">
            <ul>
                <li><a href="." class="<?php if($location=="notes") echo"active"; ?>">notes</a></li>
                <li><a href="?projects" class="<?php if($location=="projects") echo"active"; ?>">project</a></li>
                <li><a href="?settings" class="<?php if($location=="setting") echo"active"; ?>">settings</a></li>
            </ul>
        </div>
        <form action="controller/logout.php" metod="post">
        <button name="logout" class="logout">Logout</button>
        </form>
</div>
<div class="burger-menu" id="burger" >
    <i class="material-icons">menu</i>
</div>