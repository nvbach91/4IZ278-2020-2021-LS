
<?php include './includes/header.php'//include pro veci bez php, require once vypisuje jen jednou?>
<?php var_dump($_GET)//vardump vypisi obsah objektu $_POST?>
<?php echo $_GET['email']//vardump vypisi obsah objektu?>
<?php echo $_GET['password']//vardump vypisi obsah objektu?>
<?php
    
   
    $invalidInputs = [];
    $isSubmitted = !empty($_GET);
    if($isSubmitted){
        $email =  htmlspecialchars(trim($_GET['email']));
        $password =  htmlspecialcharstrim($_GET['password']));
        $remember =  isset($_GET['remember']) ? true : false;//ternalni operator 
        //if($_GET['remember']){$remember = true; els e$remember=false}
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){//aplikuje na vyraz jdsofdsj@email.cz
            array_push($invalidInputs, 'Email je zadany ale neni validni');//vlozeni do pole
        }
        if(!preg_match('/^[a-zA-Z0-9]{8,}$/',$password)){//podle regularnich vyrazu
            array_push($invalidInputs, 'Email je zadany ale neni validni');//vlozeni do pole
        }
        if(!$email){
            // chyba
            array_push($invalidInputs, 'Vyplnte emailu');//vlozeni do pole
        }
        if(!$password){
            // chyba
            array_push($invalidInputs, 'Vyplnte heslo');//vlozeni do pole
        }
        if(!count($invalidInputs)){
            $msg = 'You are successfully loged in';
        }
    }
?>
<?php if($isSubmitted):?>
    <?php if($msg) :?>
    <h1><?php echo $msg ?></h1>
    <?php endif; ?>

<main>
<h1>Some form</h1>
<form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input  name="email" value="<?php echo isset($email)? $email: ''?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Passssword</label>
    <input name="password" value="<?php echo isset($password)? $password: ''?>" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input name="remember" <?php echo isset($remember) && $remember == true ? 'checked': ''?> type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</main>
<?php endif; ?>
<?php if(!$isSubmitted):?>
<?php if (!empty($invalidInputs)):?>
   <?php foreach($invalidInputs as $msg):?>
    <p><?php echo $msg; ?></p>
   <?php endforeach;?>
   <?php endif; ?>
<h1>You have submitted the form</h1>



<?php endif; ?>
<?php include './includes/footer.php'?>