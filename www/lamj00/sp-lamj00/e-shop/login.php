<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/UsersDB.php";
$invalidInputs = [];
$usersDB = new usersDB();
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $login = $_POST['login'];
    $password = $_POST['password'];



    @$user = $usersDB -> getItem("email",$login);
    if ($user == false)
        @$user = $usersDB -> getItem("username",$login);

    if (@password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['ID'];


        header('Location: index.php');
    } else {
        array_push($invalidInputs,"Wrong sign in credentials");
    }
}
?>
<main class="cont">
    <h1 class="text-center">Log in</h1>
    <?php foreach($invalidInputs as $msg):?>
        <div class="alert alert-danger" role="alert"><?php echo $msg;?></div>
    <?php endforeach; ?>
    <form class="form-login" method="POST" action="">

        <div class="form-group">
            <label>Email or username</label>
            <input class="form-control" name="login" placeholder="Email or username" value="<?php echo $login ?? '' ?>">

        </div>
        </br>
        <div class="form-group">
            <label for="validationDefault02" class="form-label">Set password</label>
            <div class="col-auto">
                <label for="inputPassword2" class="visually-hidden">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" >
            </div>
        </div>
        <br>
        <button class="btn btn-primary" type="Login">login</button>
    </form>

</main>
<?php
require  "incl/footer.php";
?>


