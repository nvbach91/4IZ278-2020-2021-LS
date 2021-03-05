<?php include __DIR__ . '/includes/head.php'?>
<?php

$isSubmitted = empty($_POST) ? false : true;
$invalidInputs=[];

    if ($isSubmitted) {
        // var_dump($_GET);

        $email   = htmlspecialchars(trim($_POST['email']));
        $name    = htmlspecialchars(trim($_POST['name']));
        $phone   = htmlspecialchars(trim($_POST['phone']));
        $gender  = htmlspecialchars(trim($_POST['gender']));
        $avatar  = htmlspecialchars(trim($_POST['avatar']));
        $package = htmlspecialchars(trim($_POST['package']));
        $cards   = (int)htmlspecialchars(trim($_POST['cards']));

        if (!$name) {
            array_push($invalidInputs, 'Name is empty!' );
        }
        if (!$gender) {
            array_push($invalidInputs, 'Gender is empty!' );
        }
        if (!$email) {
            array_push($invalidInputs, 'Email is empty!' );
        }
        if (($email) && (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
            array_push($invalidInputs, 'Email is invalid!' );
        }

        if (!$phone) {
            array_push($invalidInputs, 'Phone is empty!' );
        }
        if (($phone) && (!preg_match('/^\+[0-9]{12}$/', $phone))){
            array_push($invalidInputs, 'Non-existent phone!');
        }
        if (!$avatar) {
            array_push($invalidInputs, 'Avatar is empty!' );
        }
        if (($avatar) && (!filter_var($avatar, FILTER_VALIDATE_URL))) {
            array_push($invalidInputs, 'URL is invalid!' );
        }
        if ((($cards<=0) || ($cards %2)!=0)) {
            array_push($invalidInputs, 'The number of cards is odd or negative!' );
        }
    }
    $isValidForm = !count($invalidInputs);// ==0
    if ($isValidForm){
        //do something more
    }
?>




<main>
    <div class="registration">
    <h1>Registration form</h1>
    </div>
    <?php if (!$isValidForm): ?>
    <h2>The form is not valid, please try again</h2>
    <?php endif; ?>
    <?php foreach ($invalidInputs as $invalidInput): ?>
    <p class="error-message"><?php echo $invalidInput; ?> </p>
            <?php endforeach; ?>
    <form class="card" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <div class="form-group">
            <label for="name">Name*</label>
            <input value="<?php echo isset($name) ? $name : '' ?>" name="name" type="text" class="form-control" id="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelectGender">Gender*</label>
            <select value="<?php echo isset($gender) ? $gender : '' ?>" class="form-control" name="gender" id="gender">
                <option>Neutral</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email address*</label>
            <input value="<?php echo isset($email) ? $email : '' ?>" name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp"
                   placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="phone">Phone*</label>
            <input value="<?php echo isset($phone) ? $phone : '' ?>" name="phone" type="text" class="form-control" id="phone"
                   placeholder="Enter phone">
            <small id="phoneHelp" class="form-text text-muted">Example: +420 xxx xxx xxx</small>
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input value="<?php echo isset($avatar) ? $avatar : '' ?>" class="form-control" name="avatar" type="text" id="avatar" placeholder="Enter URL">
        </div>
        <?php  if (isset($avatar) && $avatar!=''):  ?>
         <img alt="avatar" src="<?php echo $avatar; ?>" />
         <?php endif; ?>
        <div class="form-group">
            <label for="package">Package name</label>
            <input value="<?php echo isset($package) ? $package : '' ?>" class="form-control" type="text" name="package" id="package">
        </div>
        <div class="form-group">
            <label for="cards">Number of cards in the packege</label>
            <input value="<?php echo isset($cards) ? $cards : '' ?>" class="form-control" type="text" name="cards" id="cards">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>


    </form>
    <?php if ($isSubmitted): ?>
        <h2>You have submitted the form</h2>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/includes/foot.php'?>
