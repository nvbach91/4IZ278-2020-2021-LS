<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php
        if($currentPagination>1){
            $prevPagination = $currentPagination-1;
            echo "<li class='page-item'><a class='page-link' href='eshop.php?offset=$prevPagination'>Previous</a></li>";
        }
        for ($i = 1; $i <= $numberOfPaginations; $i++) {
            echo "<li class='page-item'><a class='page-link' href='eshop.php?offset=$i'>$i</a></li>";
        }
        if($currentPagination<$numberOfPaginations){
            $nextPagination = $currentPagination+1;
            echo "<li class='page-item'><a class='page-link' href='eshop.php?offset=$nextPagination'>Next</a></li>";
        }
        ?>
    </ul>
</nav>