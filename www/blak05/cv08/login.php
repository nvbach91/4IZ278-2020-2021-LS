<?php 
    if (!empty($_POST)) {

        // check login data!

        $username = $_POST['username'];

        setcookie('username', $username, time() + 3600);

        header('Location: index.php');
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
        .boxik{
            max-width: 400px;
            margin: 2.5rem auto;
            padding: 20px;
        }
        button{
            margin-top: 0.5rem;
        }
    </style>

    <title>Login In!</title>
  </head>
  <body>
  <div class="border p3 mb-4 boxik text-center">
    <form action="#" method="POST">
    <h2>Login</h2>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" type="name">
            <button type="submit" class="btn btn-dark">Login</button>
        </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>