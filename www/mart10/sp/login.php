<?php
require "vendor/autoload.php";
session_start();

$submittedForm = !empty($_POST);
if($submittedForm) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database();

    @$user = $db->select('SELECT * FROM `user` WHERE `UserName` = :UserName', ['UserName'=> $username]);
    if(password_verify($password, $user[0]['UserPassword'])) {
        $_SESSION['user_id'] = $user[0]['UserID'];
        $_SESSION['user_role'] = (int) $user[0]['UserRole'];
        $_SESSION["flash"] = ["type" => "success", "message" => "You are now signed in!"];

        header('Location: index.php');
    } else {
        echo '<button type="button" class="btn btn-danger" disabled>You are not signed in.</button>';
    }
}

?>

<?php require './incl/header.php'; ?>

<main class="text-center">
    <form class="form-signup" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="username"
               id="inputUsername"
               class="form-control"
               name="username" value="<?php echo $username ?? '' ?>"
               placeholder="Your username"
               required=""
               autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password"
               id="inputPassword"
               class="form-control"
               name="password" value="<?php echo $password ?? '' ?>"
               placeholder="Password"
               required="">
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</main>

<?php require './incl/footer.php'; ?>
