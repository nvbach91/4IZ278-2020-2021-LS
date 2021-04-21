<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">YourMango.com</a>    
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Košík</a>
                    </li>
                    <li class="nav-item">
                    <?php if (@$_COOKIE['username']): ?>
                        <a class="nav-link" href="profil.php"><?php echo $_COOKIE['username']; ?></a>
                        <?php else: ?>
                        <a class="nav-link" href="profil.php">Profil</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if (@$_COOKIE['username']): ?>
                        <a class="nav-link" href="logout.php">Logout</a>
                        <?php else: ?>
                        <a class="nav-link" href="login.php">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>