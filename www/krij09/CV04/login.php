<?php
require './utils/database.php';
$alerts = [];


if((isset($_GET['state']) && $_GET['state'] == "registration") && isset($_GET['email']))
{
    array_push($alerts, array("Úspěšně zaregistrován","alert-success"));
}


$form = !empty($_POST);
if($form)
{
    $email = $_POST['email'];
    $passwordPost = $_POST['password'];

    $user = fetchUser($email);

    if ($passwordPost == null){
        array_push($alerts, array("Zadejte heslo","alert-danger"));
    }

    if($email == "") {
        array_push($alerts, array("Zadejte přihlašovací e-mail", "alert-danger"));
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($alerts, array("Email je ve špatným formátu", "alert-warning"));
    }
    else if($user == null)
        array_push($alerts, array("Uživatel neexistuje", "alert-danger"));
    else if(!($_POST['password'] == $user['password']))
            array_push($alerts, array("Nesprávně zadané heslo","alert-danger"));

    if(empty($alerts))
    {
        array_push($alerts, array("Úspěšně ses přihlásil","alert-success"));
    }

}

?>

<?php include "./utils/header.php"; ?>
<div class="container">

    <form class="form-registration" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <?php if((isset($_GET['state']) && $_GET['state'] == "registration") && isset($_GET['email'])): foreach ($alerts as $alert):?>
            <div class="alert <?php echo $alert[1]; ?>"><?php echo $alert[0]; ?></div>
        <?php endforeach; endif;
                if($form): foreach ($alerts as $alert):
        ?>
        <div class="alert <?php echo $alert[1]; ?>"><?php echo $alert[0]; ?></div>
        <?php endforeach; endif; ?>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" name="password" type="password"">
        </div>
        <div class="form-group">
            <input class="btn btn-primary mt-4" style="width:100%;" type="submit">
        </div>
    </form>
</div>
<?php include "./utils/footer.php"; ?>
