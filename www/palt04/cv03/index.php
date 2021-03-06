<?php 

$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';

$submittedForm = !empty($_POST);
if ($submittedForm) {
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));

    if (!$firstname) {
        array_push($alertMessages, 'Please enter your firstname');
        array_push($invalidInputs, 'firstname');
    }

    if (!$lastname) {
        array_push($alertMessages, 'Please enter your lastname');
        array_push($invalidInputs, 'lastname');
    }

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        array_push($alertMessages, 'Please enter valid email');
        array_push($invalidInputs, 'email');
    }

    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($alertMessages, 'Please enter valid phone');
        array_push($invalidInputs, 'phone');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($alertMessages, 'Please use a valid URL for your avatar');
        array_push($invalidInputs, 'avatar');
    }
    
    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $alertMessages = ['You have successfully signed up!'];
    }


}
?>

<?php require './components/header.php'; ?>
<div style="height: 150px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M-13.26,121.38 C235.04,165.79 190.46,-61.18 500.00,49.99 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #08f;"></path></svg></div>
<section class="container-fluid registration">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="row">
                    <div class="col text-center h2 pb-2">Registration form</div>    
                </div>
                <?php if ($submittedForm): ?>
                        <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
                <?php endif; ?>    
                <div class="form-group row justify-content-center">
                <div class="row">
                    <div class="col-lg-2 px-0">
                        <label class="col-form-label">Fullname:</label>
                    </div>
                    <div class="col-5 px-1">
                        <input type="text" class="form-control<?php echo in_array('firstname', $invalidInputs) ? ' is-invalid' : '' ?>" name="firstname" value="<?php echo isset($firstname) ? $firstname : '' ?>">
                        <p class="small">e.g. Timotej</p>
                    </div>
                    <div class="col-5 px-0">
                        <input type="text" class="form-control<?php echo in_array('lastname', $invalidInputs) ? ' is-invalid' : '' ?>" name="lastname" value="<?php echo isset($lastname) ? $lastname : '' ?>">
                        <p class="small">e.g. Paluš</p>
                    </div>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label class="col-form-label">Email:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control col-form-label<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($email) ? $email : '' ?>">
                        <p class="small">e.g. lucky@gmail.com</p>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-lg-2">
                        <label class="col-form-label" for="inlineFormCustomSelect">Gender:</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-select" aria-label="Default select example" name="gender">
                            <option  value="neutral" selected>Neutral</option>
                            <option  value="man">Man</option>
                            <option  value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label class="col-form-label">Phone:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control col-form-label<?php echo in_array('phone', $invalidInputs) ? ' is-invalid' : '' ?>" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
                        <p class="small">e.g. +421333444555</p>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-lg-2">
                        <label class="col-form-label">Avatar URL:</label>
                    </div>
                    <div class="col-md-10 align-self-center">
                        <input type="text" class="form-control col-form-label<?php echo in_array('avatar', $invalidInputs) ? ' is-invalid' : '' ?>" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
                        <p class="small">e.g. https://eso.vse.cz/~palt04/cv03/img/lebron_james.jpg</p>
                    </div>
                    <div class="text-center">
                        <?php if (isset($avatar) && $avatar): ?>
                            <img class="avatar img" src="<?php echo $avatar; ?>" alt="avatar">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 align-self-center text-center">
            <img src="./img/registration.png" width="400px" class="img img-fluid py-5 px-5" alt="">
        </div>
    </div> 
</section>
<div style="height: 150px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.99 C232.22,39.47 245.20,208.22 500.00,49.99 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #08f;"></path></svg></div>
<?php require './components/footer.php'; ?>
