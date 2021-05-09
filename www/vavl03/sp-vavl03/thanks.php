<?php require __DIR__ . '/incl/header.php' ?>
<?php require __DIR__ . '/incl/navbar.php' ?>
<?php
require 'components/userRequired.php'; // pristup jen pro prihlaseneho uzivatele

?>
<div class="thanks-for-order">
    <h1>Thank you for your order!</h1>
    <h4>We sent you an email with informations about your order. You can also find your orders in 
    <a href="my_orders.php">My orders</a>.
    </h4>
</div>
<?php require __DIR__ . '/incl/footer.php' ?>
<script>
console.log(<?php echo json_encode($_SESSION); ?>);
</script>