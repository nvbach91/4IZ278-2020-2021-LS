<?php 

require './utils.php';

$alertMessages = [];
$alertType = '';

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    // get all fields while trimming them and converting any special chars to html entities
    $email = $_POST['email'];
    $password = $_POST['password'];
    $authentication = authenticate($email, $password);
    if (!$authentication['success']) {
        $alertType = 'alert-danger';
        $alertMessages['authentication'] = $authentication['msg'];
    } else {
        $alertType = 'alert-success';
        $alertMessages['authentication'] = $authentication['msg'];
    }
}

// set default email if specified in URL query string
if (isset($_GET['email'])) {
    $email = $_GET['email'];
} 

?>
<?php include './includes/header.php' ?>
<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
    <div class="inner">
        <h3 class="masthead-brand">Form</h3>
        <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link" href=".">Home</a>
        <a class="nav-link" href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
        <a class="nav-link active" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
        </nav>
    </div>
    </header>
    
    <main role="main" class="inner cover">
    <h1 class="text-center">Log In</h1>
    <form class="form-registration" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php if (isset($_GET['email']) && @$_GET['ref'] === 'registration'): ?>
            <div class="alert alert-success">Woohoo! You have successfully signed up!</div>
        <?php endif; ?>
        <?php if ($submittedForm && !empty($alertMessages)): ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
        <?php endif; ?>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
            <small class="text-muted">Example: example@google.com</small>
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" type="password" name="password" autocomplete="off">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    </main>
</div>
<?php include './includes/footer.php' ?>