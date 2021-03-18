<?php 

require __DIR__ . '/../utils.php';

$users = findUsers();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

        <title>Cover Template for Bootstrap</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">

        <!-- Bootstrap core CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../style.css" rel="stylesheet">
    </head>

    <body class="text-center">
        <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Form</h3>
                <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href=".">Home</a>
                <a class="nav-link" href="../registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                <a class="nav-link" href="../login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                </nav>
            </div>
            </header>
            
            <main role="main" class="inner cover">
            <h1 class="text-center">Users</h1>
            <?php foreach ($users as $user): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user['name']; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $user['email']; ?></h6>
                        <p class="card-text"><?php echo file_get_contents('http://loripsum.net/api/1/short/plaintext'); ?></p>
                    </div>
                </div>
                <br>
            <?php endforeach; ?>
            </main>
        </div>
    <?php require __DIR__ . '/../includes/footer.php'; ?>