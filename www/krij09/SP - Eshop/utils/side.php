<?php ?>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light min-vh-90 collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./">
                    <span data-feather="home"></span>
                    Hlavní stránka
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=cat&c=sale">
                    <span data-feather="dollar-sign"></span>
                    Zlevněné produkty
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=cat&c=all">
                    <span data-feather="list"></span>
                    Všechny produkty
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Kategorie</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <?php
            $conn = new Db(DB_Server,DB_User,DB_Pass,DB_DB);
            $conn->createConn();
            $dao = new Dao($conn->getConn());
             foreach($dao->fetchCategories() as $category): ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=cat&c=<?= $category->getCategoryId(); ?>"?>
                    <span data-feather="file-text"></span>
                    <?= $category->getName(); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
