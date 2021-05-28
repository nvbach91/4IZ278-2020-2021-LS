<?php require __DIR__ . '/incl/header.php' ?>
<?php require __DIR__ . '/incl/navbar.php' ?>
<?php require __DIR__ . '/db/UsersDB.php' ?>
<?php require __DIR__ . '/components/global.php'; ?>
<?php
require 'components/userRequired.php';

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
        $errors['zip'] = "Only numbers allowed fo ZIP code";
    }
    $userNumber = test_input($_POST['userPhoneNumber']);
    // if no errors continue to summary
    if (empty($errors)) {
        $usersDB->updateUser(
            $email,
            $userName,
            $userNumber,
            $street,
            $descNumber,
            $userCity,
            $userZip,
            $userState,
            $me->getId()
        );
        header('Location: account_details.php');
        exit();
    }
}
?>
<div class="my-orders">
    <div class="order-container delivery-details">
        <h1>Account details</h1>
        <?php if ($submittedForm && !empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <div class="account-image">
            <img src="<?php echo htmlspecialchars($picture['url'], ENT_QUOTES, 'UTF-8'); ?>" alt="profile-image" class="img-rounded img-responsive" />
        </div>
        <form class="row g-3 account-details" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="col-md-6">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputName" name="userName" value="<?php echo htmlspecialchars($userData[0]['user_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control<?php echo getInputValidClass('email', $errors); ?>" id="inputEmail" name="userEmail" value="<?php echo isset($_POST['userEmail']) ? $_POST['userEmail'] : htmlspecialchars($userData[0]['user_email'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="inputStreet" class="form-label">Street</label>
                <input type="text" class="form-control" id="inputStreet" placeholder="Main St" name="userStreet" value="<?php echo htmlspecialchars($userData[0]['user_street'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-6">
                <label for="inputDescNumber" class="form-label">Descriptive number</label>
                <input type="text" class="form-control" id="inputDescNumber" placeholder="123" name="userDescNumber" value="<?php echo htmlspecialchars($userData[0]['user_descriptive_number'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" id="inputCity" name="userCity" value="<?php echo htmlspecialchars($userData[0]['user_city'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select id="inputState" class="form-select" name="userState">
                    <option value="Czechia" <?= $userData[0]['user_state'] == 'Czechia' ? ' selected="selected"' : '' ?>>Czech republic</option>
                    <option value="Usa" <?= $userData[0]['user_state'] == 'Usa' ? ' selected="selected"' : '' ?>>USA</option>
                    <option value="Slovakia" <?= $userData[0]['user_state'] == 'Slovakia' ? ' selected="selected"' : '' ?>>Slovakia</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Zip</label>
                <input type="text" class="form-control<?php echo getInputValidClass('zip', $errors); ?>" id="inputZip" name="userZip" value="<?php echo isset($_POST['userZip']) ? $_POST['userZip'] : htmlspecialchars($userData[0]['user_zip_code'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-4">
                <label for="inputNumber" class="form-label">Phone number</label>
                <input type="tel" class="form-control" id="inputNumber" name="userPhoneNumber" value="<?php echo htmlspecialchars($userData[0]['user_phone_number'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="+420 333 333 333">
            </div>
            <div class="col-lg-12 delivery-details-btn">
                <button type="submit" class="btn btn-primary btn-lg next-btn">Update details</button>
            </div>
        </form>
    </div>
</div>
<?php require __DIR__ . '/incl/footer.php' ?>