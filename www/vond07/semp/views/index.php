<?php require __DIR__ . '/../includes/head.php'; ?>
<?php require __DIR__ . '/../includes/nav.php'; ?>

<h1 class="mt-4">Realitka</h1>
<div class="row">
    <div class="col-md-12 col-12">
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Mauris elementum mauris vitae tortor. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Proin in tellus sit amet nibh dignissim sagittis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quis nibh at felis congue commodo. Nulla quis diam. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Maecenas lorem. Donec vitae arcu. Pellentesque ipsum. Integer pellentesque quam vel velit.</p>
    </div>
</div>
<div class="row">
<?php require __DIR__ . '/../database/SizeDB.php'; ?> 

    <div class="col-md-12 col-12">
        <?php
        $sizeClass = new SizeDB();

        $data = $sizeClass->getListOfSizes();

        echo "<b>Počet velikostí: </b>";
        echo Count($data);

        foreach ($data as $row) {
            echo "<p>";
            echo $row['ID'].": ";
            echo $row['NAME']."\n";
            echo "</p>";
        }
        ?>
    </div>
</div>



<?php require __DIR__ . '/../includes/footer.php'; ?> 