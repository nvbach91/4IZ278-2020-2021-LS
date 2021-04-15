
<div class="col-sm-12">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <?php for ($i = 1;
                       $i <= ceil($count / $productsPerPage);
                       $i++) { ?>
                <li class="page-item <?php echo $offset / $productsPerPage + 1 == $i ? "active" : ""; ?>">
                    <a class="page-link"
                       href="./index.php?offset=<?php echo ($i - 1) * $productsPerPage; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>





