<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Project Planner</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['user_email'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i>Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="registration.php"">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if (isset($_SESSION['user_email'])): ?>
                <span class="navbar-text">
                  <?php echo  $_SESSION['firstName'] . ', '. $_SESSION['lastName']; ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</nav>