    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="img/logoLV_white.png" alt="logo" width="40" height="40"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'index') || preg_match('/\/$/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                    <?php if (isset($_SESSION['user_id'])) : ?>
              
                                                
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                        <?php  if($_SESSION['user_privillage'] > 2 ) : ?>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'create-item') ? ' active' : '' ?>">
                            <a class="nav-link" href="create-item.php">New</a>
                        </li>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'users') ? ' active' : '' ?>">
                            <a class="nav-link" href="users.php">Users</a>
                        </li>
                    
                        <?php endif; ?>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'wordClock') ? ' active' : '' ?>">
                            <a class="nav-link" href="worldClock.php">World Clock</a>
                        </li>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'profile') ? ' active' : '' ?>">
                            <a class="nav-link" href="#"></i> <?php echo $_SESSION['user_email']; ?></a>
                        </li>
                 
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</i></a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'signin') ? ' active' : '' ?>">
                            <a class="nav-link" href="signin.php">Sign in</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>