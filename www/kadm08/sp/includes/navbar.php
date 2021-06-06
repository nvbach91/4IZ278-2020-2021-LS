<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Coworking Smetana</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                     <?php if (isset($_SESSION['email']) && isset($_SESSION['type']) && $_SESSION['type'] == 0) : ?>
                        <li class="nav-item">
                        <li><a class="nav-link" href="myAccount.php?user_id=<?php echo $_SESSION['user_id'] ?>">My account</a>
                        </li>
                        <li class="nav-item">   
                            <a class="nav-link" href="myReservations.php?user_id=<?php echo $_SESSION['user_id'] ?>">My reservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <?php elseif (isset($_SESSION['email']) && isset($_SESSION['type']) && $_SESSION['type'] == 1) : ?>
                        <li class="nav-item">
                        <li><a class="nav-link" href="myAccount.php?user_id=<?php echo $_SESSION['user_id'] ?>">My account</a>                       
                        </li>
                        <li class="nav-item">   
                            <a class="nav-link" href="reservations.php">Reservations</a>
                        </li>
                        <li class="nav-item">   
                            <a class="nav-link" href="workplaces.php">Workplaces</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="pricing.php">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>