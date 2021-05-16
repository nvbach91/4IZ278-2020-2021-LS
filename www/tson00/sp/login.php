<?php session_start();?>
<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 
<div class="container">
<div class="center-text">
<h1>Přihlašení</h1>
</div>
  <form action="action.php" method="POST" >
  <div class="mb-3">
  <input  name="login" type="hidden">
      <label for="exampleInputEmail1" class="form-label">E-mail</label>
      <input  name="email"  value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Heslo</label>
      <input  type="password" name="password" value="" class="form-control" id="password" aria-describedby="password">
    </div>  
    <div class="center-button">  
    <button type="submit" class="btn btn-primary">Přihlasit</button> 
    </div>
  </form>
</div>

<?php include './includes/footer.php'?>