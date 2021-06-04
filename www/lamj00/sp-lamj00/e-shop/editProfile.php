<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/Profile.php";
$invalidInputs = [];

if ("GET" == $_SERVER['REQUEST_METHOD']) {
    if ($_GET["user_id"] != $_SESSION["user_id"]):
        require "adminRequired.php";
    endif;
    $profile = new Profile($_GET["user_id"]);
}
if ("POST" == $_SERVER['REQUEST_METHOD']) {
    $usersDB = new UsersDB();
    $id = array_key_last($_POST);
    $profile = new Profile($id);

    $firstName = htmlspecialchars(trim(($_POST['firstName'])));
    $lastName = htmlspecialchars(trim(($_POST['lastName'])));
    $address = htmlspecialchars(trim(($_POST['address'])));
    $username = htmlspecialchars(trim(($_POST['username'])));
    $email = htmlspecialchars(trim(($_POST['email'])));
    $password = htmlspecialchars(trim(($_POST['password'])));

    if (!$username) {
        array_push($invalidInputs, 'Username not set');
    } elseif ($usersDB->getItem("username", $username) != false) {
        if ($usersDB->getItem("username", $username)["ID"] != $profile->getID()) {
            array_push($invalidInputs, 'Username already in use');
        }
    } elseif (strlen($username) < 6) {
        array_push($invalidInputs, 'Username is too small');
    } elseif (strlen($username) > 20) {
        array_push($invalidInputs, 'Username is too long');
    }
    if (!$email) {
        array_push($invalidInputs, 'Email not set');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email is not valid');
    } elseif ($usersDB->getItem("email", $email) != false) {
        if ($usersDB->getItem("email", $email)["ID"] != $profile->getID()) {
            array_push($invalidInputs, 'Email already in use');
        }

    }
    if ($password)
        if (strlen($password) < 6) {
            array_push($invalidInputs, 'Password is too small');
        } elseif (strlen($password) > 20) {
            array_push($invalidInputs, 'Password is too long');

            if (!$address) {
                array_push($invalidInputs, 'Address is not set');
            }


        }
    if (empty($invalidInputs)) {

        $id = array_key_last($_POST);
        $usersDB->updateItem($id, "username", $_POST["username"]);
        $usersDB->updateItem($id, "firstName", $_POST["firstName"]);
        $usersDB->updateItem($id, "lastName", $_POST["lastName"]);
        $usersDB->updateItem($id, "address", $_POST["address"]);
        $usersDB->updateItem($id, "email", $_POST["email"]);
        if ($password) {
            $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $usersDB->updateItem($id, "password", $hashedPassword);
        }


    }

}

?>

<div class="cont">
    <h1 class="text-center">Edit Profile</h1>
    <br>
    <?php foreach ($invalidInputs as $msg): ?>
        <div class="alert alert-danger" role="alert"><?php echo $msg; ?></div>
    <?php endforeach; ?>
    <form action="" method="POST" name="<?php echo $profile->getId() ?>" id="<?php echo $profile->getId() ?>">
        <label>Username</label>
        <input class="form-control" type="text" name="username" value="<?php echo $profile->getUsername() ?>">
        <label>First name</label>
        <input class="form-control" type="text" name="firstName" value="<?php echo $profile->getFirstName() ?>">
        <label>Last name</label>
        <input class="form-control" type="text" name="lastName" value="<?php echo $profile->getLastName() ?>">
        <label>Address</label>
        <input class="form-control" type="text" name="address" value="<?php echo $profile->getAddress() ?>">
        <label>Email</label>
        <input class="form-control" type="text" name="email" value="<?php echo $profile->getEmail() ?>">
        <label>Password</label>
        <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <?php
        require_once "db/Profile.php";
        $prof = new Profile($_SESSION["user_id"]);
        $priv = $prof->getPrivileges();
        if ($priv == 3):?>
            <label>Privileges</label>
            <div class="input-group">
                <select class="form-select">
                    <option <?php echo $profile->getPrivileges() == 1 ? ' selected' : '' ?> value="1">User</option>
                    <option <?php echo $profile->getPrivileges() == 3 ? ' selected' : '' ?> value="3">Admin</option>
                </select>
            </div>
        <?php endif; ?>
        <button class="btn btn-outline-primary" name="<?php echo $profile->getId() ?>" type="submit">
            Submit changes
        </button>
    </form>
</div>
<?php
require "incl/footer.php";
?>


