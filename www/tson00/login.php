<?php require __DIR__ . '/database_connection.php'; ?>
<?php    
 session_start();?>
<?php
$message = "";
$email = "";
$hash = "";
$password = "";
$results = "";
if(isset($_POST['login']) && !empty($_POST['email']) 
&& !empty($_POST['password'])){
  $sql = "SELECT * FROM user WHERE email = '".$_POST['email']."'";
  $statementa = $pdo->prepare($sql);
  $statementa->execute();
  $results = $statementa->fetchAll();
  if(!empty($results[0]['email'])){
    if(!empty($results[0]['email']) && !empty($results[0]['password'])){
    $hash = $results[0]['password'];
    $password = $_POST['password'];
    if (password_verify($password, $hash)) {  
        $_SESSION["id"] = $results[0]["id"];
        $_SESSION["email"] = $results[0]["email"];
        $_SESSION["name"] = $results[0]["name"];
        $_SESSION["username"] = $results[0]["username"];
        header('Location: index.php');
      }else{
   $message = "špatně zadané heslo nebo email";
  }
}
}else{
  $message = "špatně zadané heslo nebo email";
 }
}




?>
<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 
<div class="container">
<div class="center-text">
<h1>Přihlašení</h1>
</div>
  <form action="" method="POST" >
<?php if(!empty($message)){?>
  <div class="alert"><?php if($message!="") { echo $message; } ?></div>
<?php
}?>

  <div class="mb-3">
  <input  name="login" type="hidden">
      <label for="email" class="form-label">E-mail</label>
      <input  name="email"   class="form-control" id="email" value="" >
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Heslo</label>
      <input  type="password" name="password" class="form-control" value="" id="password" aria-describedby="password">
    </div>  
    <div class="center-button">  
    <button type="submit" class="btn btn-primary">Přihlasit</button> 
    </div>
  </form>
</div>



<?php include './includes/footer.php'?>