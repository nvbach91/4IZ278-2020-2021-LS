<nav class="navbar navbar-expand-lg navbar-light bg-light grad">
    <div class="container">
        <a class="navbar-brand" href=""><img src="img/icon.jpg" height="40" width="50" alt=""/> Componentoro </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-end"  id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="eshop.php">E-shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacts.php">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(!$_SERVER['REQUEST_URI']):echo 'disabled" tabindex="-1" aria-disabled="true" ';endif;?> href="cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>