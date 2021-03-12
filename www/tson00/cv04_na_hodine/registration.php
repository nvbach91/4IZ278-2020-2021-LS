
<?php require './includes/header.php'//include pro veci bez php, require once vypisuje jen jednou?>

<?php
  $errors = [];
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
function makeRegistration($data){
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
    $user = [
      'name' =>$fields[0],
      'email' =>$fields[1],
      'passwords' =>$fields[2],
    ];
    if($user['name'] === $data['name']){
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
 $typ = '';
    $isPosted = !empty($_POST);
    $image = '';
    $invalidInputs = [];
   
    
    if($isPosted){

      $name =  htmlspecialchars(trim($_POST['name']));
      $surname =  htmlspecialchars(trim($_POST['surname']));
      $email =  htmlspecialchars(trim($_POST['email']));
      $phone =  htmlspecialchars(trim($_POST['phone']));
      $image =  htmlspecialchars(trim($_POST['image']));
      $password = $_POST['password'];
      $confirm = $_POST['confirm'];

      if($password !== $confirm){
        array_push($invalidInputs, 'password dont match');
      }
     
      //$image = filter_var($_POST['image'], FILTER_SANITIZE_URL);
      $amount =  htmlspecialchars(trim($_POST['amount']));
      $gender =  htmlspecialchars(trim(isset($_POST['gender'])));
      $deck =  isset($_POST['deck']);
      
      $empty = [
        ['post'=>$name,'name'=>'Name',], 
        ['post'=>$surname,'name'=>'Surname',], 
        ['post'=>$email,'name'=>'Email',], 
        ['post'=>$phone,'name'=>'Phone',], 
        ['post'=>$image,'name'=>'Image',], 
        ['post'=>$amount,'name'=>'Amount',], 
        ['post'=>$gender,'name'=>'Gender',], 
        ['post'=>$deck,'name'=>'Deck',],];
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
           if(!preg_match('/^[A-Za-z]*$/',$surname)){//podle regularnich vyrazu
             array_push($invalidInputs, 'Wrong format surname');//vlozeni do pole
           }
           if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
             array_push($invalidInputs, 'Wrong format email');//vlozeni do pole
           }
           if(!preg_match('/^[0-9]*$/',$phone)){//po
             array_push($invalidInputs, 'Wrong format phone number');//vlozeni do pole
           }
           if(!filter_var($image, FILTER_VALIDATE_URL)){
             array_push($invalidInputs, 'Wrong format image link');//vlozeni do pole
           }
           if(!preg_match('/^[0-9]*$/',$amount)){//po
             array_push($invalidInputs, 'Wrong format number of cards');//vlozeni do pole
           }
           if (!count($invalidInputs)){
            
            echo"You are successfully loged in";
            sendEmail($email, 'Registration','success','hello, thank you for you registration');

               //   echo "Email successfully sent";
                //  $to_email = $email;
                //  $subject = "Simple Email Test via PHP";
               //   $body = "Hi,nn This is test email send by PHP Script";
                //  $headers = "From: sender\'s email";
                   
                //  if (mail($to_email, $subject, $body, $headers)) {
              //        echo "Email successfully sent to $to_email...";
             //     } else {
             //         echo "Email sending failed...";
             $registrationResult = makeRegistration($_POST);
             if($registrationResult['success'] ===true){
              header("Location: login.php?email=$email");
             }else{
              echo"error";

             }

              $typ = " <button type='button' class='btn btn-primary'>button</button>";
          
           }
            
    
           
           
           
         }
         
?>
<?php if (!empty($invalidInputs)):?>
   <?php foreach($invalidInputs as $msg):?>
    <p><?php echo $msg;?></p>
   <?php endforeach;?>
   <?php endif; ?>
   <?php require './includes/navigation.php'//include pro veci bez php, require once vypisuje jen jednou?>

<h1>Player registration</h1>
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
    <label for="surname" class="form-label">Surname</label>
    <input  name="surname" value="<?php echo isset($surname)? $surname: ''?>" class="form-control" id="surname" aria-describedby="surname">
  </div>
  <div class="mb-3">
    <label for="gender" class="form-label">Select gender</label>
    <select name="gender" id="gender" class="form-control">
    <?php if (!empty($gender)):?>
      <option  style="display:none;" value="<?php echo $_POST['gender'] ?>"><?php echo $_POST['gender']?></option>
      <?php else :?>
      <option style="display:none;"> -- select an option -- </option>
      <?php endif; ?>
      <option value="female">female</option> 
      <option value="male">male</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input  name="email" value="<?php echo isset($email)? $email: ''?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input  name="phone" value="<?php echo isset($phone)? $phone: ''?>" class="form-control" id="phone" aria-describedby="phone">
  </div>
  <div class="mb-3">

   <?php if (!empty($image)):;?>
   <label for="image" class="form-label">Profile image</label>
   <img name="image" id="image" alt="image" src="<?php echo $image?>">
  <?php else:?>
        <label for="image" class="form-label">Profile image link</label>
        <input  name="image" value="<?php echo isset($image)? $image: ''?>"  class="form-control" id="image" aria-describedby="image">
        <?php endif; ?>
  </div>
  <div class="mb-3">
    <label for="deck" class="form-label">Select Deck</label>
    <select name="deck" id="deck" class="form-control">
    <?php if (!empty($deck)):?>
      <option  style="display:none;" value="<?php echo $_POST['deck'] ?>"><?php echo $_POST['deck']?></option>
      <?php else :?>
      <option style="display:none;"> -- select an option -- </option>
      <?php endif; ?>
      <option value="red">red</option> 
      <option value="black">black</option>
      <option value="white">white</option>
      <option value="blue">blue</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="amount" class="form-label">Select number of cards in the deck.</label>
    <input  name="amount" value="<?php echo isset($amount)? $amount: ''?>" class="form-control" id="amount" aria-describedby="amount">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
 <?php echo $typ?>
  
</form>

<?php require './includes/footer.php'?>





