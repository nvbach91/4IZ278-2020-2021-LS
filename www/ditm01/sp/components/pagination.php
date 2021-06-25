<?php for ($i = 1; $i <= $numberOfPaginations; $i++) { ?>
    <li class="page-item <?php echo $offset / $nItems + 1 == $i ? 'active ' : ''; ?>">
        <a class="page-link" href="shop?<?php echo $selectedCategory ?>offset=<?php echo $nItems * ($i - 1); ?>">
            <?php echo $i; ?>
        </a>
    </li>
<?php } ?>