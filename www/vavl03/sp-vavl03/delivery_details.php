<?php require __DIR__ . '/incl/header.php' ?>
<?php require __DIR__ . '/incl/navbar.php' ?>
<?php require __DIR__ . '/db/UsersDB.php' ?>
<?php require __DIR__ . '/components/global.php'; ?>
<?php
require 'components/userRequired.php';

if (isset($_SESSION['orderSent'])) {
    header('Location: ../sp-vavl03/index.php');
    exit();
}
/* if user has details already stored in database, set session details = details from db and pre-load session details not db details,
 because if user changes details I want to preload new details from session not old from db*/

$usersDB = new UsersDB();
$userData = $usersDB->fetchUserbyFbId($me->getId());

// check if form is submitted and validate it
$submittedForm = !empty($_POST);
$errors = [];
if ($submittedForm) {
    $userName = test_input($_POST["userName"]);
    $email = test_input($_POST['userEmail']);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    $street = test_input($_POST['userStreet']);
    $descNumber = test_input($_POST['userDescNumber']);
    $userCity = test_input($_POST['userCity']);
    $userState = $_POST['userState'];
    $userZip = test_input($_POST['userZip']);
    if (!preg_match("/^(0|[1-9][0-9]*)$/", $userZip)) {
        $errors['zip'] = "Only numbers allowed for ZIP code";
    }
    $userNumber = test_input($_POST['userNumber']);
    // if no errors continue to summary
    if (empty($errors)) {
        $_SESSION['userName'] = $userName;
        $_SESSION['userEmail'] = $email;
        $_SESSION['userStreet'] = $street;
        $_SESSION['userDescNumber'] = $descNumber;
        $_SESSION['userCity'] = $userCity;
        $_SESSION['userState'] = $userState;
        $_SESSION['userZip'] = $userZip;
        $_SESSION['userNumber'] = $userNumber;
        header('Location: order_summary.php');
        exit();
    }
}
?>
<div class="order-methods delivery-details">
    <h1>Delivery details:</h1>
    <?php if ($submittedForm && !empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php echo implode('<br>', array_values($errors)); ?>
        </div>
    <?php endif; ?>
    <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="col-md-6">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputName" name="userName" <?= isset($_SESSION['userName']) ? ' value="' . $_SESSION['userName'] . '"' : 'value="' . $userData[0]['user_name'] . '"'; ?> required>
            <small class="text-muted">Example: Dan Bilzerian</small>
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control<?php echo getInputValidClass('email', $errors); ?>" id="inputEmail" name="userEmail" <?= isset($_POST['userEmail']) ?  ' value="' . $_POST['userEmail'] . '"' : (isset($_SESSION['userEmail']) ? ' value="' . $_SESSION['userEmail'] . '"' : 'value="' . $userData[0]['user_email'] . '"'); ?> required>
            <small class="text-muted">Example: abc@gmail.com</small>
        </div>
        <div class="col-md-6">
            <label for="inputStreet" class="form-label">Street</label>
            <input type="text" class="form-control" id="inputStreet" placeholder="Main St" name="userStreet" <?= isset($_SESSION['userStreet']) ? ' value="' . $_SESSION['userStreet'] . '"' : 'value="' . $userData[0]['user_street'] . '"'; ?> required>
        </div>
        <div class="col-md-6">
            <label for="inputDescNumber" class="form-label">Descriptive number</label>
            <input type="text" class="form-control" id="inputDescNumber" placeholder="123" name="userDescNumber" <?= isset($_SESSION['userDescNumber']) ? ' value="' . $_SESSION['userDescNumber'] . '"' : 'value="' . $userData[0]['user_descriptive_number'] . '"'; ?> required>
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">City</label>
            <input type="text" class="form-control" id="inputCity" name="userCity" <?= isset($_SESSION['userCity']) ? ' value="' . $_SESSION['userCity'] . '"' : 'value="' . $userData[0]['user_city'] . '"'; ?> required>
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">State</label>
            <select id="inputState" class="form-select" name="userState">
                <option value="Czechia" <?= (isset($_SESSION['userState']) && $_SESSION['userState'] == 'Czechia') || $userData[0]['user_state'] == 'Czechia' ? ' selected="selected"' : ''; ?>>Czech republic</option>
                <option value="Usa" <?= (isset($_SESSION['userState']) && $_SESSION['userState'] == 'Usa') || $userData[0]['user_state'] == 'Usa' ? ' selected="selected"' : ''; ?>>USA</option>
                <option value="Slovakia" <?= (isset($_SESSION['userState']) && $_SESSION['userState'] == 'Slovakia') || $userData[0]['user_state'] == 'Slovakia' ? ' selected="selected"' : ''; ?>>Slovakia</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="inputZip" class="form-label">Zip</label>
            <input type="text" class="form-control<?php echo getInputValidClass('zip', $errors); ?>" id="inputZip" name="userZip" <?= isset($_POST['userZip']) ? ' value="' . $_POST['userZip'] . '"' : (isset($_SESSION['userZip']) ? ' value="' . $_SESSION['userZip'] . '"' : 'value="' . $userData[0]['user_zip_code'] . '"'); ?> required>
        </div>
        <div class="col-md-4">
            <label for="inputNumber" class="form-label">Phone number</label>
            <input type="tel" class="form-control" id="inputNumber" name="userNumber" <?= isset($_SESSION['userNumber']) ? ' value="' . $_SESSION['userNumber'] . '"' : 'value="' . $userData[0]['user_phone_number'] . '"'; ?> required placeholder="+420 333 333 333">
        </div>
        <div class="delivery-btns">
            <a href="order_methods.php" class="btn btn-secondary btn-lg">Back</a>
            <input type="submit" class="btn btn-primary btn-lg next-btn" value="Next"></input>
        </div>
    </form>

</div>
<?php require __DIR__ . '/incl/footer.php' ?>