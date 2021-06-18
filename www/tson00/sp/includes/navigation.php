 <!-- Navigation -->
 <?php
$id = @$_SESSION['id'];
$sql = "SELECT admin FROM admin WHERE id_user = :id;";
$statement = $pdo->prepare($sql);
$statement->execute([
    'id' => $id,
]);
$res = $statement->fetchAll();
?>

<?php
$id = @$_SESSION['id'];
$sql = "SELECT COUNT(DISTINCT (bor.id)) as count FROM borrowing bor
left join product pro on pro.id = bor.id_product
WHERE pro.id_user = :id and bor.status in (4,6)";
$statement = $pdo->prepare($sql);
$statement->execute([
    'id' => $id,
]);
$require = $statement->fetchAll();
?>

<?php
$id = @$_SESSION['id'];
$sql = "SELECT COUNT(DISTINCT (bor.id)) as countbor FROM borrowing bor
left join product pro on pro.id = bor.id_product
WHERE bor.id_user = :id and bor.status in (4,6)";
$statement = $pdo->prepare($sql);
$statement->execute([
    'id' => $id,
]);
$borrowing = $statement->fetchAll();

?>



<nav id="nav" class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./index.php">SOUSEDI</a>
    </div>
    <ul class="nav navbar-nav">
      <li <?php if($_SERVER['SCRIPT_NAME']=="/~tson00/sp/index.php") { ?>  class="active"   <?php   }  ?>><a href="./index.php">Hlavní stránka</a></li>
    <?php if (!empty($_SESSION["username"])){?>
    
      <li <?php if($_SERVER['SCRIPT_NAME']=="/~tson00/sp/myproduct.php") { ?>  class="active"   <?php   }  ?>><a   href="./myproduct.php">Moje zboží</a></li>
      <li <?php if($_SERVER['SCRIPT_NAME']=="/~tson00/sp/borrow.php") { ?>  class="active"   <?php   }  ?>><a  href="./borrow.php">Výpůjčky(<?php echo $borrowing[0]['countbor'];?>)</a></li>          
      <li <?php if($_SERVER['SCRIPT_NAME']=="/~tson00/sp/requirements.php") { ?>  class="active"   <?php   }  ?> ><a   href="./requirements.php">Požadavky(<?php echo $require[0]['count'];?>)</a></li>
      
      <li <?php if($_SERVER['SCRIPT_NAME']=="/~tson00/sp/profile.php") { ?>  id="active"   <?php   }  ?> class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION["username"]; ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li <?php if($_SERVER['SCRIPT_NAME']=="/~tson00/sp/profile.php") { ?>  class="active"   <?php   }  ?>><a href="./profile.php">profil</a></li>
        </ul>
      </li>
    <?php }?>
    <?php if (isset($res[0]['admin'])==1){?>
    <li <?php if($_SERVER['SCRIPT_NAME']=="/~tson00/sp/statistics.php") { ?>  class="active"   <?php   }  ?>><a  href="./statistics.php">Statistika</a></li>
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

