<?php

if (empty($_POST)) {
    $isSubmitted = false;
} else {
    $isSubmitted = true;
}

$isSubmitted = empty($_POST) ? false : true;
$invalidInputs = [];

if ($isSubmitted) {
    $name = htmlspecialchars(trim($_POST['name']));
    $sex = htmlspecialchars(trim($_POST['sex']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = trim($_POST['avatar']);
    $deckName = htmlspecialchars(trim($_POST['deckName']));
    $cards = htmlspecialchars(trim($_POST['cards']));

    if (!$email) {
        array_push($invalidInputs, 'Email je prazdny');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email je neplatny');
    }

    if(!preg_match('/^[0-9]{9}$/',$phone))
    {
        array_push($invalidInputs, 'Phone number is in incorrect format');
    }

    if($cards != 30)
    {
        array_push($invalidInputs, 'Incorrect number of cards');
    }

    $isValidForm = count($invalidInputs) == 0;
}

?>

<?php include './includes/head.php'; ?>

<h1>Hearthstone Amateur League</h1>
<main>
    <?php if ($isSubmitted) : ?>
        <h2> You submitted</h2>
    <?php endif; ?>
    <?php if ($isValidForm) : ?>
        <h2> valid form. You are registered </h2>
        <div>
            <img src="<?php echo $avatar ?>" width="100" height="100" alt="avatar">
         </div>
        <?php 
        $message = "You have been successfully registered to Hearthstone Amateur League tournament.";
        mail($email, 'Hearthstone tournament registration', $message); 
        ?> 
    <?php endif; ?>
    <?php if (!$isValidForm) : ?>
        <h2> invalid form. </h2>
    <?php endif; ?>


    <?php foreach ($invalidInputs as $invalidInput) : ?>
        <p><?php echo $invalidInput; ?>
        <?php endforeach ?>
        <form method="POST">
        <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input value="<?php echo isset($name) ? $name : '' ?>" name="name" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Sex</label>
                <input value="<?php echo isset($sex) ? $sex : '' ?>" name="sex" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input value="<?php echo isset($email) ? $email : '' ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phone</label>
                <input value="<?php echo isset($phone) ? $phone : '' ?>" name="phone" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Profile picture URL</label>
                <input value="<?php echo isset($avatar) ? $avatar : '' ?>" name="avatar" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Deck name</label>
                <input value="<?php echo isset($deckName) ? $deckName : '' ?>" name="deckName" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Control question: Number of cards in your deck?</label>
                <input value="<?php echo isset($cards) ? $cards : '' ?>" name="cards" class="form-control" id="exampleInputEmail1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</main>

<?php include './includes/foot.php'; ?>