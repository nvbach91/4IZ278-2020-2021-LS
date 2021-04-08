<?php /** @var array $categories */ ?>
<ul class="nav justify-content-center bg-light">
    <li class="nav-item">
        <a href="/" class="nav-link">
            Všechny produkty
        </a>
    </li>
    <?php foreach ($categories as $category): ?>
        <li class="nav-item">
            <a href="?category=<?= $category["category_id"] ?>" class="nav-link">
                <?= $category["name"] ?>
                <span class="badge bg-secondary"><?= $category["products_count"] ?></span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>