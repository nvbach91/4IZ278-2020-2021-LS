<?php require __DIR__ . '/incl/header.php' ?>
<?php require __DIR__ . '/incl/navbar.php' ?>
<?php
require 'components/userRequired.php';
?>
<div class="thanks-for-order">
    <h1>Unfortunately someone else has already bought your products :(</h1>
    <h4>Please start a new order, thanks!
        <a href="index.php">Go to home page</a>.
    </h4>
</div>
<?php require __DIR__ . '/incl/footer.php' ?>