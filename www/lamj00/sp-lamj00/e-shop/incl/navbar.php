<nav class="navbar navbar-expand-lg navbar-light bg-light grad">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="img/icon.jpg" height="40" width="50" alt=""/> Componentoro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'index') ? ' active' : '' ?>"
                       aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'eshop') ? ' active' : '' ?>"
                       href="eshop.php">E-shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'aboutUs') ? ' active' : '' ?>"
                       href="aboutUs.php">About us</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php
                    require_once "db/Profile.php";
                    $profile = new Profile($_SESSION["user_id"]);
                    $privilege = $profile->getPrivileges();
                    if ($privilege ==3):
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'users') ? ' active' : '' ?> "
                               href="users.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'orders') ? ' active' : '' ?> "
                               href="orders.php">Orders</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?> "
                           href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'profile') ? ' active' : '' ?> "
                           href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log out</i></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>"
                           href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'registration') ? ' active' : '' ?>"
                           href="registration.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>