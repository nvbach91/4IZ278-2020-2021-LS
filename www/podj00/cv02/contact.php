
<?php include './includes/header.php' ?>
<body>
    <h1>Hlavička</h1>
    <h2><?php echo createShortNumber(1000000) ?></h2>
    <ul>
        <?php foreach ($dogs as $d) : ?>
            <li>
                <div class="dog-name">
                <?php echo $d->type; ?>
                </div>
                <div class="dog-name">
                <?php echo $d->gender; ?>
                </div>
                <div class="dog-name">
                <?php echo $d->weight; ?>
                </div>
                <div class="dog-name">
                <?php echo $d->getDimensions(); ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php include './includes/footer.php' ?>
