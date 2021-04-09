<?php 
    session_start();
    $ids = @$_SESSION['cart'];


    if (!empty($_GET)) {

        // check login data!

        $id = $_GET['id'];
        array_push($ids, $id);
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