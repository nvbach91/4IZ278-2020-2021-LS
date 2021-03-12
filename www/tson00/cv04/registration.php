<?php require './includes/header.php'//include pro veci bez php, require once vypisuje jen jednou?>
<?php
  //$errors = [];
  function sendEmail($recipient,$subject, $message){
    $headers=[
    'MIME-version: 1.0',
    'Content-type: text/html, charset=utf-8',
    'From: app@dev.com',
    'Reply-To: app@dev.com',
    'X-Mailer: PHP/8.0',
    ];
    $msg ="<h1>Registration confirmation</h1><p>$message</p>";
    return mail($recipient,$subject, $msg, implode("\r\n",$headers));
}

  
  function registerNewUser($data){
    $databaseFileName = __DIR__.'/database/users.db';
    $success = false;
    $message = '';

    $lines = file($databaseFileName); //vsechno bude v pole
    $isExistingUser = false;
      foreach($lines as $line){
        if(!$line){
          continue;
        }
        //cely zaznam ktery zpracujeme
        $fields = explode(';',$line);//rozdelime udaje
        $user = ['name' =>$fields[0],
                'email' =>$fields[1],
                'passwords' =>$fields[2],];
        if($user['email'] === $data['email']){
          $isExistingUser = true;
          break;
        }
      }
    if($isExistingUser){
      $message = 'user already exist';
    }
      if(!$isExistingUser){
        $userInformation = [
            $data['name'],
            $data['email'],
            $data['password'],
            ];
        //vyrobit zaznam ve stringu
        $newRecord = implode(';', $userInformation) ."\r\n";
        //vlozit do souboru
        file_put_contents($databaseFileName,$newRecord,FILE_APPEND);
        $success = true;
      }
    $result = [
      'success' => $success,
      'message' => $message,
    ];
    return $result;
  }
    $isPosted = !empty($_POST);
    $invalidInputs = [];   
    if($isPosted){
      $name =  htmlspecialchars(trim($_POST['name']));  
      $email =  htmlspecialchars(trim($_POST['email']));    
      $password = $_POST['password'];
      $confirm = $_POST['confirm'];
        if($password !== $confirm){
          array_push($invalidInputs, 'password dont match');
        }
        $empty = [
          ['post'=>$name,'name'=>'Name',], 
          ['post'=>$password,'name'=>'Password',], 
          ['post'=>$email,'name'=>'Email',], 
          ['post'=>$confirm,'name'=>'Confirm password',], 
        ];
        foreach($empty as $emp){
          if(isset($emp['post'])){
            $emp['post']='';
          }
        }
      foreach($empty as $emp){
        if(empty($emp['post'])){
          $text = ''; 
          $text .= $emp['name'];
          $text .= ' is required'; 
          array_push($invalidInputs, $text);//vlozeni do pole
        }
      }
      foreach($empty as $emp){
        if(isset($emp['post'])){
          $text = ''; 
          array_push($emp, $text);//vlozeni do pole
        }
      }
     
      if(!preg_match('/^[A-Za-z]*$/',$name)){//podle regularnich vyrazu
            array_push($invalidInputs, 'Wrong format name');//vlozeni do pole
      }
          
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
             array_push($invalidInputs, 'Wrong format email');//vlozeni do pole
      }
          
      if(!count($invalidInputs)){     
        sendEmail($email, 'Registration','success','hello, thank you for you registration');
        $registrationResult = registerNewUser($_POST);
          if($registrationResult['success'] ===true){
            echo $registrationResult['message'];
            header("Location: login.php?email=$email");
          }else{
            echo $registrationResult['message'];
          }          
      }           
    }         
?>
<?php if (!empty($invalidInputs)):?>
   <?php foreach($invalidInputs as $msg):?>
   <p><?php echo $msg;?></p>
   <?php endforeach;?>
   <?php endif; ?>
   <?php require './includes/navigation.php'//include pro veci bez php, require once vypisuje jen jednou?>

<h1>User registration</h1>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input  name="name" value="<?php echo isset($name)? $name: ''?>" class="form-control" id="name" aria-describedby="name">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input  name="password" value="<?php echo isset($password)? $password: ''?>" class="form-control" id="password" aria-describedby="password">
    </div>
    <div class="mb-3">
      <label for="confirm" class="form-label">Confirm Password</label>
      <input  name="confirm" value="<?php echo isset($confirm)? $confirm: ''?>" class="form-control" id="confirm" aria-describedby="confirm">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input  name="email" value="<?php echo isset($email)? $email: ''?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button> 
  </form>
<?php require './includes/footer.php'?>