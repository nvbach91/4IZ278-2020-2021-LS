<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./index.php">SOUSEDI</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="./index.php">Hlavní stránka</a></li>
    <?php if (!empty($_SESSION["username"])){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION["username"]; ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./profile.php">profil</a></li>
          <li><a href="./borrow.php">výpůjčky</a></li>
          <li><a href="./myproduct.php">moje zboží</a></li>
          <li><a href="./requirements.php">požadavky</a></li>
        </ul>
      </li>
    <?php }?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php if (empty($_SESSION["username"])){?>
      <li><a href="./registration.php"><span class="glyphicon glyphicon-user"></span>Registrace</a></li>
      <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Přihlasit se</a></li>
      <?php }else{?>
      <li><a href="./logout.php"><span class="glyphicon glyphicon-log-in"></span> Odhlásit se</a></li>
      <?php }?>
    </ul>
  </div>
</nav>
  
<!--<div class="container">
  <h3>Right Aligned Navbar</h3>
  <p>The .navbar-right class is used to right-align navigation bar buttons.</p>
</div>-->