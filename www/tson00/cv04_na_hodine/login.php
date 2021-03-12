
<?php require './includes/header.php'//include pro veci bez php, require once vypisuje jen jednou?>
<?php require './includes/navigation.php'//include pro veci bez php, require once vypisuje jen jednou?>
    <h1>Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >

  
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input  name="email" value="<?php echo isset($email)? $email: ''?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input  name="password" value="<?php echo isset($password)? $password: ''?>" class="form-control" id="password" aria-describedby="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
 
  
</form>
<?php require './includes/footer.php'?>