<?php include __DIR__ . '/includes/header.php' ?>
<?php
$msg = '';
$msgClass = '';

if (filter_has_var(INPUT_POST, 'submit')) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatarUrl = htmlspecialchars(trim($_POST['avatarUrl']));
    $game = htmlspecialchars(trim($_POST['game']));
    $number = htmlspecialchars(trim($_POST['number']));

   

    
    if (!(empty($name)) 
    && (!empty($email)) 
    && (!empty($phone))
     && (!empty($avatarUrl))
      && (!empty($game))
       && (!empty($number))
       ) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = 'Please enter a valid email!';
            $msgClass = 'alert-danger';
        } else if (!preg_match("/^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/", $phone)) {
            $msg = "Invalid phone number!";
            $msgClass = 'alert-danger';
            
        }
        else if (!preg_match("/^(0|[1-9][0-9]*)$/", $number)) {
            $msg = "Invalid number of cards!";
            $msgClass = 'alert-danger';
            
        }
         else {
            $msg = "Your form has been successfully sent!";
            $msgClass = 'alert-success';
        }
    } else {
        $msg = 'Please fill in all fields!';
        $msgClass = 'alert-danger';
    }
}

?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="index.php" class="navbar-brand">4IZ278 - Lukáš Vít</a>
        </div>
    </div>
</nav>

<div class="container">
    <?php if ($msg != '') : ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>
    <form class="form-signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Gender</label>
            <select class="form-control" name="gender" value="<?php echo isset($gender) ? $gender : ''; ?>">
              
                <option>Neutral</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
            <small class="text-muted">Example: +420 823 829 922</small>
        </div>
        <div class="form-group">
            <label>Avatar URL</label>
            <?php if (!empty($avatarUrl)) : ?>
                <?php echo "<img src=".$avatarUrl." height=50 width=80 />"; ?>
            <?php endif; ?>
            <input class="form-control" name="avatarUrl" value="<?php echo isset($avatarUrl) ? $avatarUrl : ''; ?>">
            <small class="text-muted">Example: https://eso.vse.cz/~nguv03/cv03/img/homer.jpg</small>
            
        </div>
        <div class="form-group">
            <label>Game</label>
            <input class="form-control" name="game" value="<?php echo isset($game) ? $game : ''; ?>">
        </div>
        <div class="form-group">
            <label>Number of cards</label>
            <input class="form-control" name="number" value="<?php echo isset($number) ? $number : ''; ?>">
        </div>
        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
    </form>
</div>

<?php include '../footer.php'; ?>