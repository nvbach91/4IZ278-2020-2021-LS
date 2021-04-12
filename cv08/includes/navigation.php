    <!-- Navigation -->
    <?php
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="img/logoLV_white.png" alt="logo" width="40" height="40"></a>
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
                    <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>



                    <?php if (@$_COOKIE['username']) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="create-item.php">Create Product</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        <?php else :
                        ?>

                            <a class="nav-link" href="login.php">Go to login</a>
                        <?php endif;
                        ?>


                        </li>

                </ul>
            </div>
        </div>
    </nav>