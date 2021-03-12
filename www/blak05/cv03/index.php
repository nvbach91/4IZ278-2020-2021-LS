<?php include 'includes/head.php'?>
<?php 
    $invalidInputs = ['fullName' => '', 'email' => '', 'phone' => '', 'profilePic' => '', 'deckName' => '', 'numCards' => ''];
    $isSubmitted = !empty($_POST);
    $email = '';
    $isFull = false;
    
    if($isSubmitted){
        $fullName = htmlspecialchars($_POST['fullName']);
        $gender = $_POST['gender'];
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $profilePic = htmlspecialchars(trim($_POST['profilePic']));
        $deckName = htmlspecialchars($_POST['deckName']);
        $numCards = htmlspecialchars(trim($_POST['numCards']));

        if(empty($_POST['fullName'])){
            $invalidInputs['fullName'] = "Full Name is required <br />";
        }else{
            $fullName = $_POST['fullName'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $fullName)){
                $errors['fullName'] =  "Full Name must be letters, and spaces only";
            }
        }

        if(empty($_POST['email'])){
            $invalidInputs['email'] = "Email is required <br />";
        }else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $invalidInputs['email'] = "email must be a valid email address";
            }
        }

        if(empty($_POST['phone'])){
            $invalidInputs['phone'] = "Phone is required <br />";
        }else{
            $phone = $_POST['phone'];
            if(!preg_match('/^[0-9]{9}\z/', $phone)){
                $invalidInputs['phone'] =  "Phone must be 9 numbers only";
            }
        }

        if(empty($_POST['profilePic'])){
            $invalidInputs['profilePic'] = "URL of a profile pic is required <br />";
        }else{
            $profilePic = $_POST['profilePic'];
            if(!preg_match('%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i', $profilePic)){
                $invalidInputs['profilePic'] =  "It has to be an url. Add www. or http://";
            }
        }

        if(empty($_POST['deckName'])){
          /*  $invalidInputs['deckName'] = "Your deck needs a name <br />"; */
            $deckName = "Without his own Deck";
            $numCards = 0;
        } else{
            if(empty($_POST['numCards']) && !$deckName == "Without his own Deck"){
                $invalidInputs['numCards'] = "If your deck has a name, then it has cards! <br />";
            }elseif($deckName == "Without his own Deck"){
                $numCards = 0;
            }
            else{
                $numCards = $_POST['numCards'];
                if(!preg_match('/^[1-9][0-9]{0,15}$/', $numCards)){
                    $invalidInputs['numCards'] =  "We need a number (max 15 digits)";
                }
            }
        }

        foreach($invalidInputs as $error){
            if($error){
                $isFull = false;
                break;
            }else{
                $isFull = true;
            }
        }

    }

?>
<main>
    <h1 class="text-center">REGISTRACE HRÁČE MTG</h1>
    <form action="index.php" method="POST">
        <div class="mb-3">
            <label for="fullName" class="form-label">Your Name:</label>
            <input name="fullName" class="form-control" id="fullName" aria-describedby="emailHelp" value="<?php echo isset($fullName) ? $fullName : '' ?>">
            <?php if($invalidInputs['fullName']): ?>
                <div class="alert alert-danger" role="alert"><?php echo $invalidInputs['fullName']; ?></div>
            <?php endif;?>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Your gender:</label>
            <select name="gender" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Your Email address:</label>
            <input name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo isset($email) ? $email : '' ?>">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            <?php if($invalidInputs['email']): ?>
                <div class="alert alert-danger" role="alert"><?php echo $invalidInputs['email']; ?></div>
            <?php endif;?>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Your phone:</label>
            <input name="phone" class="form-control" id="phone" aria-describedby="emailHelp" value="<?php echo isset($phone) ? $phone : '' ?>">
            <?php if($invalidInputs['phone']): ?>
                <div class="alert alert-danger" role="alert"><?php echo $invalidInputs['phone']; ?></div>
            <?php endif;?>
        </div>
        <div class="mb-3">
            <label for="profilePic" class="form-label">Your profile pic (URL):</label>
            <input name="profilePic" class="form-control" id="profilePic" value="<?php echo isset($profilePic) ? $profilePic : '' ?>">
            <?php if($invalidInputs['profilePic']): ?>
                <div class="alert alert-danger" role="alert"><?php echo $invalidInputs['profilePic']; ?></div>
            <?php endif;?>
        </div>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="deckName" class="form-label">Name of Deck:</label>
                <input name="deckName" class="form-control" id="deckName" value="<?php echo isset($deckName) ? $deckName : '' ?>">
                <?php if($invalidInputs['deckName']): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $invalidInputs['deckName']; ?></div>
                <?php endif;?>
            </div>
            <div class="col-sm-6">
                <label for="numCards" class="form-label">Number of cards:</label>
                <input name="numCards" class="form-control" id="numCards" value="<?php echo isset($numCards) ? $numCards : '' ?>">
                <?php if($invalidInputs['numCards']): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $invalidInputs['numCards']; ?></div>
                <?php endif;?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</main>
<?php if($isFull): ?>
    <div class="text-center you">
        <h2>You have submitted the form!</h2>
        <p>
            About you:<?php echo " Your name is $fullName, you are $gender, and your opponents can contact you here: $email, $phone "?>
        </p>
        <img src="<?php echo $profilePic?>" alt="Avatar - <?php echo $fullName?>"> 
        <p>Your deck is called <?php echo "$deckName and has $numCards cards" ?></p>
    </div>
<?php endif; ?>

<?php include 'includes/foot.php' ?>