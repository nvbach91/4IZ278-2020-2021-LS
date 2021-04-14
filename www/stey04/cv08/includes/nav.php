    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="https://eso.vse.cz/~nguv03/cv08/img/logo.png" width="30" height="30" alt="">
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'index') ? ' active' : '' ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if (@$_COOKIE['name']) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif ?>

            </ul>
        </div>
    </nav>