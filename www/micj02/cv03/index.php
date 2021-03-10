<?php include 'include/header.php' ?>
<?php //var_dump($_GET);?>
<?php //echo $_GET['email']?>
<?php //echo $_GET['password']?>
<?php
$isSubmitted = !empty($_POST);
$errors = [];
$success_message = "";
$fields = [];
$genderList = ['Man', 'Woman', 'Other'];

if ($isSubmitted) {
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $image = htmlspecialchars(trim($_POST['image']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $packName = htmlspecialchars(trim($_POST['packName']));
    $numberOfCards = htmlspecialchars(trim($_POST['numberOfCards']));
    $password = htmlspecialchars(trim($_POST['password']));

    # validate first name
    if (!$firstName) {
        array_push($errors, 'Please enter your name.');
    } elseif (!preg_match('/^[a-zA-Z]{1,20}$/', $firstName)) {
        array_push($errors, 'Name should be only letters under 20 characters (no diacritics).');
    }

    # validate last name
    if (!$lastName) {
        array_push($errors, 'Please enter your last name.');
    } elseif (!preg_match('/^[a-zA-Z]{1,30}$/', $lastName)) {
        array_push($errors, 'Last name should be only letters under 30 characters (no diacritics).');
    }

    # validate image
    if (!preg_match('/^(https?:\/\/)?.*$/', $image)) {
        array_push($errors, 'Enter valid image url.');
    }

    # validate email
    if (!$email) {
        array_push($errors, 'Please enter email.');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid email.');
    }

    # validate phone number
    if (!$phoneNumber) {
        array_push($errors, 'Please enter phone number.');
    } elseif (!preg_match('/^[\d]{1,10}$/', $phoneNumber)) {
        array_push($errors, 'Phone number should contain only numbers and should have max 10 digits.');
    }

    # validate gender
    if (!in_array($gender, $genderList)) {
        array_push($errors, 'Please choose from offered options.');
    }

    # validate pack name
    if (!$packName) {
        array_push($errors, 'Please enter your last name.');
    } elseif (!preg_match('/^[a-zA-Z]{1,30}$/', $packName)) {
        array_push($errors, 'Pack name should be only letters under 30 characters (no diacritics).');
    }

    # validate number of cards
    if (!preg_match('/^[\d]{1,10}$/', $numberOfCards) || $numberOfCards <= 0) {
        array_push($errors, 'Number of cards has to be integer above zero');
    }

    # validate password
    if (!$password) {
        array_push($errors, 'Please enter your password.');
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        array_push($errors, 'Password should be at alphanumeric and at least 8 characters long.');
    }


    if (!count($errors)) {
        $success_message = 'Success!';
    }
}
?>
<div class="row"><h1 class="m-3">CV03</h1></div>
<div class="row">
    <div class="col-6">
        <div class="card w-50 m-3">
            <div class="m-3">
                <form method="post">
                    <div>
                        <label for="firstName" class="form-label">First name</label>
                        <input name="firstName" value="<?php echo isset($firstName) ? $firstName : "" ?>"
                               class="form-control" id="firstName">
                    </div>
                    <div>
                        <label for="lastName" class="form-label">Last name</label>
                        <input name="lastName" value="<?php echo isset($lastName) ? $lastName : "" ?>"
                               class="form-control" id="lastName">
                    </div>
                    <div>
                        <label for="image" class="form-label">Image</label>
                        <input name="image" value="<?php echo isset($image) ? $image : "" ?>" class="form-control"
                               id="image">
                    </div>
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input name="email" value="<?php echo isset($email) ? $email : "" ?>" class="form-control"
                               id="exampleInputEmail1">
                    </div>
                    <div>
                        <label for="phoneNumber" class="form-label">Phone number</label>
                        <input name="phoneNumber" value="<?php echo isset($phoneNumber) ? $phoneNumber : "" ?>"
                               class="form-control" id="phoneNumber">
                    </div>
                    <div>
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" class="form-control" id="gender">
                            <option>Man</option>
                            <option>Woman</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="packName" class="form-label">Pack name</label>
                        <input name="packName" value="<?php echo isset($packName) ? $packName : "" ?>"
                               class="form-control" id="packName">
                    </div>
                    <div>
                        <label for="numberOfCards" class="form-label">Number of cards</label>
                        <input name="numberOfCards" value="<?php echo isset($numberOfCards) ? $numberOfCards : "" ?>"
                               class="form-control" id="numberOfCards">
                    </div>
                    <div>
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" value="<?php echo isset($password) ? $password : "" ?>"
                               class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>

        <?php if ($isSubmitted): ?>
            <h2 class="m-3">You have submitted the form</h2>
            <?php if ($errors): ?>
                <?php foreach ($errors as $msg): ?>
                    <div class="m-3 w-50">
                        <p><?php echo $msg ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="m-3 w-50">
                    <h3>
                        <?php echo $success_message ?>
                    </h3>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
    <div class="col-6">
        <div class="m-3 w-50 h-50">
            <img src="<?php echo isset($image) ? $image : "" ?>" alt="no img" class="img-thumbnail">
        </div>
    </div>
</div>
<?php include 'include/footer.php' ?>
