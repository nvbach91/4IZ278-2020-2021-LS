<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="resources/style.css" rel="stylesheet">
    <title>Hello, world!</title>
</head>
<body class="d-flex flex-column h-100">
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="." class="nav-link px-2 text-secondary">Home</a></li>
                <li><a href="about.php" class="nav-link px-2 text-white">About us</a></li>
                <li><a href="shop.php" class="nav-link px-2 text-white">Shop</a></li>
                <li><a href="contacts.php" class="nav-link px-2 text-white">Contacts</a></li>

            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control form-control-dark" placeholder="Search...">
            </form>

            <div class="text-end">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="btn btn-outline-light me-2">My Account</a>
                    <a href="logout.php" class="btn btn-warning me-2">Log out</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light me-2">Login</a>
                    <a href="signup.php" class="btn btn-warning">Sign-up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>