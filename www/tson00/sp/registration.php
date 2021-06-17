<?php require __DIR__ . '/database_connection.php'; ?>
<?php 
function sendEmail($recipient,$subject, $message){
  $headers=[
  'MIME-version: 1.0',
  'Content-type: text/html, charset=utf-8',
  'From: app@dev.com',
  'Reply-To: app@dev.com',
  'X-Mailer: PHP/8.0',
  ];
  $msg ="<h1>Podtvrzení o registrace</h1><p>$message</p>";
  return mail($recipient,$subject, $msg, implode("\r\n",$headers));
}

$message = "";
$password = "";
$confirm = "";
$name ="";
$surname ="";
$univesity ="";
$dormitory ="";
$username ="";
$phone ="";
$email ="";
if(isset($_POST['registration'])){
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $univesity =$_POST['university'];
    $dormitory = $_POST['dormitory'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $sqlemail = "SELECT email FROM user where email = '$email'";
    $statementemail = $pdo->prepare($sqlemail);
    $statementemail->execute();
    $emailarray = $statementemail->fetchAll();

    $sqlusername = "SELECT username FROM user where username = '$username'";
    $statementusername = $pdo->prepare($sqlusername);
    $statementusername->execute();
    $usernamearray = $statementusername->fetchAll();
    if(!empty($emailarray[0]['email'])){
      $message = 'Tento email je již zaregistrovaný';
    }elseif(!empty($emailarray[0]['username'])){
      $message = 'Tento username je již zaregistrovaný';
    }else{
    if($password  == $confirm){
        $optionhash = ['cost' => 16];
        $hash = password_hash($password, PASSWORD_BCRYPT,$optionhash);
        $sql = "INSERT INTO user (name, surname, id_university, id_dormitory, username, phone, email, password)  
        VALUES (?,?,?,?,?,?,?,?)";
         $statement = $pdo->prepare($sql);
         $statement->execute([$name,$surname,$univesity,$dormitory,$username,$phone,$email ,$hash]);
         sendEmail($email, 'Registration','Nyní se můžete přihlašovat do aplikace sousedi https://eso.vse.cz/~tson00/sp/login.php');

         header('Location: login.php');
    }else{
        $message = 'Hesla se neshodují';
    }
  }
    
}
?>
<?php 



    $sql = "SELECT * FROM university";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();


    // print_r($results);

?>
<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 

<div class="container">
    <div class="center-text">
        <h1>Registrace</h1>
    </div>
  <form action="" method="POST" >
  <?php if(!empty($message)){?>
  <div class="alert"><?php if($message!="") { echo $message; } ?></div>
<?php
}?>
    <div class="mb-3">
      <label for="name" class="form-label">Jméno</label>
      <input  name="registration" type="hidden">
      <input  type="text" name="name" value="" class="form-control" id="name" aria-describedby="name" required>
    </div>
    <div class="mb-3">
      <label for="surname" class="form-label">Příjmení</label>
      <input  type="text" name="surname" value="" class="form-control" id="surname" aria-describedby="surname" required>
    </div>
    <div class="mb-3">
      <label for="university" class="form-label">Univerzita</label>
      <select class="form-control" name="university" id="university" required>
      <option value="" style="display:none"></option>  
        <?php foreach($results as $result): ?>
          <option value="<?php echo $result['id'];?>"><?php echo $result['name']; ?></option>  
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="dormitory" class="form-label">Kolej</label>
      <select class="form-control" name="dormitory" id="dormitory" required>
      <option value="" style="display:none"></option>  
      </select>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Heslo</label>
      <input  type="password" name="password" value="" class="form-control" id="password" aria-describedby="password" required>
    </div>
    <div class="mb-3">
      <label for="confirm" class="form-label">Heslo znovu</label>
      <input  type="password" name="confirm" value="" class="form-control" id="confirm" aria-describedby="confirm" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">E-mail</label>
      <input  name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    </div>
    <div class="mb-3">
      <label for="username" class="form-label">Uživatelkské jméno</label>
      <input  type="text" name="username" value="" class="form-control" id="username" aria-describedby="username" required>
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Telefon</label>
      <input  type="number" name="phone" value="" class="form-control" id="phone" aria-describedby="phone" required>
    </div>
    <div class="center-button">  
    <button type="submit" class="btn btn-primary">Registrace</button> 
    </div>
  </form>
</div>
<?php include './includes/footer.php'?>