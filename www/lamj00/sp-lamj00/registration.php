<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/usersDB.php";

$usersDB = new usersDB();
$products =

$invalidInputs = [];
$isSubmitted = !empty($_POST);
if($isSubmitted) {
    $firstName=  htmlspecialchars(trim(($_POST['firstName'])));
    $lastName = htmlspecialchars(trim(($_POST['lastName'])));
    $address = htmlspecialchars(trim(($_POST['address'])));
    $username = htmlspecialchars(trim(($_POST['username'])));
    $email = htmlspecialchars(trim(($_POST['email'])));
    $password = htmlspecialchars(trim(($_POST['password'])));
    $approve_password = htmlspecialchars(trim(($_POST['confirmPassword'])));

    if (!$username) {
        array_push($invalidInputs, 'Username not set');
    }
    elseif($usersDB -> getItem("username",$username) != false){
        array_push($invalidInputs, 'Username already in use');
    }elseif (strlen($username) <6  ) {
        array_push($invalidInputs, 'Username is too small');
    }elseif (strlen($username) >20  ) {
        array_push($invalidInputs, 'Username is too long');
    }
    if (!$email) {
        array_push($invalidInputs, 'Email not set');
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs,'Email is not valid');
    }
    elseif($usersDB -> getItem("email",$email) != false){
        array_push($invalidInputs, 'Email already in use');
    }
    if (!$password) {
        array_push($invalidInputs, 'Password is not set');
    }elseif (strlen($password) <6 ) {
        array_push($invalidInputs, 'Password is too small');
    }elseif (strlen($password) >20 ) {
        array_push($invalidInputs, 'Password is too long');
    } elseif ($password !== $approve_password) {
        array_push($invalidInputs, 'Password is not same');
    }
    if(!$address){
        array_push($invalidInputs, 'Address is not set');
    }
    if(empty($invalidInputs)){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $usersDB ->addItem([$username,$email,$hashedPassword,$address,$firstName,$lastName]);
        session_start();
        $item = $usersDB -> getItem("email",$email);
        $_SESSION['ID'] = $item["ID"];
        header("Location: eshop.php");
    }
}

?>
<main class="cont">

    <h1 class="text-center">Register</h1>
    <div class="row justify-content-center">
    </div>
    <form class="form-login row g-3" method="POST" action="">
        <?php foreach($invalidInputs as $msg):?>
            <div class="alert alert-danger" role="alert"><?php echo $msg;?></div>
        <?php endforeach; ?>
        <div class="col-md-6">
            <label class="form-label">First name</label>
            <input type="text" class="form-control" name="firstName" placeholder="Mark" value="<?php echo $firstName ?? '' ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Last name</label>
            <input type="text" class="form-control" name="lastName" placeholder="Otto" value="<?php echo $lastName ?? '' ?>">
        </div>
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="username" placeholder="Username" value="<?php echo $username ?? '' ?>">
            <small class="text-muted">Must be more then 6 characters long and shorter then 20.</small>
        </div>
        <div class="col-md-6">
            <label for="validationDefault02" class="form-label">Set password</label>
            <div class="col-auto">
                <label for="inputPassword2" class="visually-hidden">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" >
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationDefault02" class="form-label"> </br></label>
            <div class="col-auto">
                <label for="inputPassword2" class="visually-hidden">Password</label>
                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm">
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control"
                   name="email" id="exampleInputEmail1"
                   aria-describedby="emailHelp" placeholder="example@componentoro.com"
                   value="<?php echo $email ?? '' ?>">
            <div id="emailHelp" class="form-text">Must have a form of email.</div>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input class="form-control" name="address"
                   placeholder="Street name and number, city, ZIP "
                   value="<?php echo $address ?? '' ?>">
            <small class="text-muted">Make sure address is correct.</small>
        </div>

        <button class="btn btn-primary" type="Login">Submit</button>
    </form>
    </div>
</main>
<?php
require  "incl/footer.php";
?>


