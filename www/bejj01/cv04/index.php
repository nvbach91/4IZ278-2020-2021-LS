<?php include __DIR__ . '/includes/header.php'?>

<main class="container col-md-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Welcome to MyPage</h1>
    </div>
    <br>
    <div class="row justify-content-center">
        <img style="width: 200px;" src="./img/rune.png" alt="Page rune logo">
    </div>
    <br>
    <div class="divider bold"></div>
    <div class="row justify-content-center border-container bg-dark">
        <div class="intro-sign">
            <p class="lead">Are you new to this page?</p>
            <p><a class="btn btn-info" href="./registration-form.php">Register</a></p>
            <div class="divider"></div>
            <p class="lead">You already have an account?</p>
            <p><a class="btn btn-info" href="./login-form.php">Login</a></p>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'?> 
