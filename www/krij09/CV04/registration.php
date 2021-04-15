<?php

require "./utils/database.php";

function registerNewUser($data){
    $users = fetchUsers();
    $success = false;
    $userExists = false;


    foreach($users as $user){
        if(!$user)
            continue;

        if($user['email'] == $data['email']){
            array_push($alerts, array("Email je již používán","alert-warning"));
            $userExists = true;
            break;
        }
    }

    if(!$userExists)
    {
        $line = [
            $data['name'],
            $data['email'],
            $data['password']
        ];

        $applyLine = implode(',', $line) . "\r\n";
        file_put_contents('./user.db',$applyLine, FILE_APPEND);
        $success = true;
    }


    return $success;


}


$alerts = [];
$form = !empty($_POST);
$gender = "none";
$regex = "/\+([0-9]{3}\s)([0-9]{3}\s)([0-9]{3}\s)([0-9]{3})$/";
if($form)
{
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordCheck = htmlspecialchars($_POST['passwordCheck']);

    if($name == "")
        array_push($alerts, array("Zadejte uživatelské jméno","alert-danger"));

    if($email == "")
        array_push($alerts, array("Zadejte email","alert-danger"));
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($alerts, array("Email je ve špatným formátu","alert-warning"));

    if($password == "")
        array_push($alerts, array("Zadejte heslo","alert-danger"));

    if($passwordCheck == "")
        array_push($alerts, array("Zadejte heslo pro kontrolu","alert-danger"));

    if(!($password == $passwordCheck))
        array_push($alerts, array("Hesla se neshodují","alert-warning"));


    if(empty($alerts))
    {
        if(registerNewUser($_POST))
        {
            header('Location: login.php?state=registration&email='.$email);
        }
        array_push($alerts,array("Úspěšně ses zaregistroval","alert-success"));
    }

}

?>

<?php include "./utils/header.php"; ?>
<div class="container">
    <form class="form-signup" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <?php if($form): foreach ($alerts as $alert):?>
        <div class="alert <?php echo $alert[1]; ?>"><?php echo $alert[0]; ?></div>
        <?php endforeach; endif; ?>
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : "" ?>">
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : "" ?>">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" name="password" type="password">

        </div>
        <div class="form-group">
            <label>Password Again*</label>
            <input class="form-control" name="passwordCheck" type="password">
        </div>
        <button class="btn btn-primary mt-4" type="submit" style="width:100%;">Submit</button>
    </form>
</div>
<?php include "./utils/footer.php"; ?>