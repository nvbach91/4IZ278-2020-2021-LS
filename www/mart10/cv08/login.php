<?php

if(!empty($_POST)) {


    $username = $_POST['username'];

    setcookie('username', $username, time() + 3600);
    header('Location: index.php');
    exit();
}

?>


<?php require './incl/header.php'; ?>
    <h2>Login</h2>
    <form method="POST">
        <label>Username</label>
        <input class="form-control" id="username" name="username" placeholder="username">
        <button type="submit">Login</button>
    </form> 
    <?php require './incl/footer.php'; ?>