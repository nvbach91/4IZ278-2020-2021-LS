<?php ?>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light min-vh-90 collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./">
                    <span data-feather="home"></span>
                    <?php if(!isset($_GET["c"])): ?>
                    <strong>Hlavní stránka</strong>
                    <?php else: ?>
                    Hlavní stránka
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=cat&c=sale">
                    <span data-feather="dollar-sign"></span>
                    <?php if(isset($_GET["c"])): if($_GET["c"] == "sale"): ?>
                    <strong>Zlevněné produkty</strong>
                    <?php else: ?>
                    Zlevněné produkty
                    <?php endif; else: ?>
                    Zlevněné produkty
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?p=cat&c=all">
                    <span data-feather="list"></span>
                    <?php if(isset($_GET["c"])): if($_GET["c"] == "all"): ?>
                        <strong>Všechny produkty</strong>
                    <?php else: ?>
                        Všechny produkty
                    <?php endif; else: ?>
                        Všechny produkty
                    <?php endif; ?>
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
                    <span data-feather="file-text" ></span>
                    <?php if(isset($_GET["c"])): if($_GET["c"] == $category->getCategoryId()): ?>
                    <strong><?= $category->getName(); ?></strong>
                    <?php else: ?>
                        <?= $category->getName(); ?>
                    <?php endif; else: ?>
                        <?= $category->getName(); ?>
                    <?php endif; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
