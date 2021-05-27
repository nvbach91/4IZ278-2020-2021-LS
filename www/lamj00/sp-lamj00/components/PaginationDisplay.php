<nav aria-label="Page navigation example" style="align-self: center">
    <ul class="pagination">
        <?php
        if($currentPagination>1){
            $prevPagination = $currentPagination-1;
            echo "<li class='page-item'><a class='page-link' href='eshop.php?offset=$prevPagination&category=$cat'>Previous</a></li>";
        }
        for ($i = 1; $i <= $numberOfPaginations; $i++) {
            echo "<li class='page-item'><a class='page-link' href='eshop.php?offset=$i&category=$cat'>$i</a></li>";
        }
        if($currentPagination<$numberOfPaginations){
            $nextPagination = $currentPagination+1;
            echo "<li class='page-item'><a class='page-link' href='eshop.php?offset=$nextPagination&category=$cat'>Next</a></li>";
        }
        ?>
    </ul>
</nav>