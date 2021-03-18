<?php 

require __DIR__ . '/../utils/utils.php';

$users = fetchUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My App</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="../">CV 04 HOMEWORK</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link" href="./users.php">Other users<span class="sr-only">(current)</span></a></li>
                </ul>
            </div>
        </nav>
    </header>
<main class="container">
    <br>
    <h1 class="text-center">Users</h1>
    <?php foreach ($users as $user): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name: <?php echo $user['name']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">email: <?php echo $user['email']; ?></h6>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
</main>

<?php require __DIR__ . '/../incl/footer.php'; ?>