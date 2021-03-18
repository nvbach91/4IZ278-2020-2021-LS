<?php require './includes/header.php'//include pro veci bez php, require once vypisuje jen jednou?>
<?php
  $errors = [];

  

  function makeRegistration($data){
    $databaseFileName = __DIR__.'/database/users.db';
    $success = false;
    $message = '';

    //$email = $data['email'];

    $lines = file($databaseFileName); //vsechno bude v pole
    $isExistingUser = false;
      foreach($lines as $line){//kdyz potkame prazdny
        if(!$line){
          continue;
        }
        //cely zaznam ktery zpracujeme
        $fields = explode(';',$line);//rozdelime udaje
       
        $user = ['email' =>$fields[1],
        'passwords' =>$fields[2],];
        if((trim($user['email']) === trim($data['email']))&&(trim($user['passwords']) === trim($data['password']))){
          $isExistingUser = true;
          break;
        }        
        }
     
      
    if($isExistingUser){
      $message = 'Success log in';
     $success = true;
    }
      if(!$isExistingUser){
        $message =   'Wrong email or password';
        $success = false;
      }
    $result = [
      'success' => $success,
      'message' => $message,
    ];
    return $result;
  }
  $isPosted = !empty($_POST);
    
    if($isPosted){ 
      $email =  htmlspecialchars(trim($_POST['email']));    
      $password = htmlspecialchars(trim($_POST['password']));
     
          
   
        $registrationResult = makeRegistration($_POST);
          if($registrationResult['success'] ===true){
         

           echo $registrationResult['message'];
           
          }else{
          

            echo $registrationResult['message'];
          }        
      }    

           
?>
<?php if (!empty($invalidInputs)):?>
   <?php foreach($invalidInputs as $msg):?>
   <p><?php echo $msg;echo$registrationResult['message'];?></p>
   <?php endforeach;?>
   <?php endif; ?>
   <?php require './includes/navigation.php'//include pro veci bez php, require once vypisuje jen jednou?>

<h1>Login</h1>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
  <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input  name="email"  value="<?php echo isset($_GET['email']) ? $_GET['email']: ''?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input  name="password" value="" class="form-control" id="password" aria-describedby="password">
    </div>    
    <button type="submit" class="btn btn-primary">Submit</button> 
  </form>
<?php require './includes/footer.php'?>