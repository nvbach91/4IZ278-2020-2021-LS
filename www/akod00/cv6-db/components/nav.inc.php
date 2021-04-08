<?php
  function activeMenu($name)
  {
    global $pageTitle;

    return $name === $pageTitle
      ? " active"
      : "";
  }

?>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="/~akod00/cv06">
        Store
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item<?php echo activeMenu('Home') ?>">
          <a class="nav-link" href="/~akod00/cv06">Home</a>
        </li>
        <li class="nav-item<?php echo activeMenu('About') ?>">
          <a class="nav-link" href="/~akod00/cv06/pages/about.php">About</a>
        </li>
      </ul>
      <?php
        if (!isset($pageTitle) || ($pageTitle !== "Login" && $pageTitle !== "Register")) {
          require __DIR__ . "/navAuth.inc.php";
        }
      ?>
    </div>
  </nav>
</header>
