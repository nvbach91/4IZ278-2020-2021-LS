<?php 
    if (!empty($_POST)) {

        // check login data!

        $username = $_POST['username'];

        setcookie('username', $username, time() + 3600);

        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Login</h2>
    <form acion="." method="POST">
        <label>Username</label>
        <input name="username">
        <button>Login</button>
    </form>
</body>
</html>