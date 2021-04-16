


<?php
   if(isset($_COOKIE['username'])):
    setcookie('username', '',time() - 3600);
    header('Location: index.php');
endif;


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-shop</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
    <link href="styles2.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css'>
</head>



<body>
    <?php require __DIR__ . '/includes/navigation.php'; ?>

    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="box" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">>
                    <h1>Login</h1>
                    <p class="text-muted"> Please enter your login and password!</p> <input type="text" name="username" placeholder="Username"> 
                    <input type="password" name="password" placeholder="Password"> 
                    <a class="forgot text-muted" href="#">Forgot password?</a> 
                    <input type="submit" name="submit" value="Login" href="#">
                    <div class="col-md-12">
                        <ul class="social-network social-circle">
                            <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
