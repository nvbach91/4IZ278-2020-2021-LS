<?php

require __DIR__ . '/utils/utils.php';

$email = $_GET['email'];
$user = getUser($email);

if (!$user) {
    header('Location: login-form.php');
    exit();
}

?>

<?php include './includes/header.php'?>

<main class="container text-center">
    <br>
    <h1 class="text-center">User Profile</h1>
    <div class="divider"></div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-5 border border-white bg-dark">
            <h4 class="text-center text-info"><?php echo strtoupper($user['name']); ?></h5>
            <div class="divider" style="margin-top: 0;"></div>
            <p class="text-muted">Contact information:</p>
            <div class="d-flex justify-content-between">
                <span>Email:</span>
                <span><?php echo $user['email']?></span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Github profile:</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Website:</span>
            </div>
        </div>
    </div>
    <br>
    <form class="text-center" style="border: none; width: 100%; margin: 0;" method="GET" action="login-form.php">
        <input type="hidden" name="email" value="<?php echo @$email; ?>">
        <input type="hidden" name="from" value="profile">
        <button type="submit" class="btn btn-info">Log Off</button>
    </form>
</main>


<?php include './includes/footer.php'?> 