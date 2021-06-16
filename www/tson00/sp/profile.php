<?php require __DIR__ . '/database_connection.php'; ?>
<?php session_start();
$message = "";
$messageconf ="";
$password = "";
$confirm = "";
$univesity ="";
$dormitory ="";
$phone ="";
if(isset($_POST['profile'])){
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $univesity =$_POST['university'];
    $dormitory = $_POST['dormitory'];
    $phone = $_POST['phone'];

    if(!empty($password) && !empty($confirm)){
        if($password  == $confirm){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $update = "UPDATE user SET password='".$hash."' WHERE id='".$_SESSION["id"]."'";
            $stat = $pdo->prepare($update);
            $stat->execute();
        }else{
            $message = 'Hesla se neshodují';
        }
    }
    $update = "UPDATE user SET phone='".$phone."',id_university='".$univesity."',id_dormitory='".$dormitory."' WHERE id='".$_SESSION["id"]."'";
    $statementupt = $pdo->prepare($update);
    $statementupt->execute();
    $messageconf = 'Uloženo';
}
?>
<?php 
    $sql = "SELECT * FROM university";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    $profile = "SELECT us.*,uni.id as university_id, uni.name as university_name,dorm.id as dormitory_id, dorm.name as dormitory_name FROM user us 
    left join university uni on uni.id = us.id_university left join dormitory dorm on dorm.id = us.id_dormitory WHERE us.id = '".$_SESSION["id"]."'";
    $statement = $pdo->prepare($profile);
    $statement->execute();
    $profileresult = $statement->fetchAll();
?>
<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 

<div class="container">
<div class="center-text">
    <h1><?php echo $profileresult[0]['name'];echo " ".$profileresult[0]['surname'];?></h1>
</div>
<form action="" method="POST" >
<?php if(!empty($message)){?>
<div class="alert"><?php if($message!="") { echo $message; } ?></div>
<?php
}?>
<?php if(!empty($messageconf)){?>
<div class="accept"><?php if($messageconf!="") { echo $messageconf; } ?></div>
<?php
}?>
<input  name="profile" type="hidden">
<div class="center-text">
  <h3><?php echo "username: ".$profileresult[0]['username'];?></h3>
</div>
<div class="center-text">
  <h3><?php echo "email: ".$profileresult[0]['email'];?></h3>
</div>


<div class="mb-3">
  <label for="university" class="form-label">Univerzita</label>
  <select class="form-control" name="university" id="university" required>
  <option value="<?php echo $profileresult[0]['university_id'];?>" style="display:none"><?php echo $profileresult[0]['university_name'];?></option>  
    <?php foreach($results as $result): ?>
      <option value="<?php echo $result['id'];?>"><?php echo $result['name']; ?></option>  
    <?php endforeach; ?>
  </select>
</div>
<div class="mb-3">
  <label for="dormitory" class="form-label">Kolej</label>
  <select class="form-control" name="dormitory" id="dormitory" required>
  <option value="<?php echo $profileresult[0]['dormitory_id'];?>" style="display:none"><?php echo $profileresult[0]['dormitory_name'];?></option>  
  </select>
</div>
<div class="mb-3">
  <label for="password" class="form-label">Heslo</label>
  <input  type="password" name="password" value="" class="form-control" id="password" aria-describedby="password" >
</div>
<div class="mb-3">
  <label for="confirm" class="form-label">Heslo znovu</label>
  <input  type="password" name="confirm" value="" class="form-control" id="confirm" aria-describedby="confirm" >
</div>
<div class="mb-3">
  <label for="phone" class="form-label">Telefon</label>
  <input  type="number" name="phone" value="<?php echo $profileresult[0]['phone'];?>" class="form-control" id="phone" aria-describedby="phone" required>
</div>
<div class="center-button">  
<button type="submit" class="btn btn-primary">Uložit změny</button> 
</div>
</form>
</div>
<?php include './includes/footer.php'?>