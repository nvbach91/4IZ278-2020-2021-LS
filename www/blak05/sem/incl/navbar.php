<header class="p-3 bg-dark text-white fixed-top">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="./" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none logo">
                <img src="./img/logo.png" style="height:50px;">
            </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="./" class="nav-link px-2 text-warning">Domů</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Naše piva</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pivní pomůcky</a></li>
          <li><a href="./blog.php" class="nav-link px-2 text-white">Blog</a></li>
          <li><a href="./onas.php" class="nav-link px-2 text-white">O Pivotéce</a></li>
        </ul>
        
        <?php if(isset($_COOKIE['priv'])): ?>
            <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./img/pp.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Moje objednávky</a></li>
            <li><a class="dropdown-item" href="#">Nastavení</a></li>
            <li><a class="dropdown-item" href="#">Můj profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./logout.php">Odhlásit se</a></li>
          </ul>
        </div>
        <button type="button" class="btn btn-warning">Košík</button>
      </div>
        <?php else: ?>
            <div class="text-end">
          <a href="./login.php"><button type="button" class="btn btn-outline-light me-2">Přihlásit se</button></a>
          <a href="./signin.php"><button type="button" class="btn btn-warning">Registrace</button></a>
        </div>
        <?php endif ?>
      </div>
    </div>
  </header>