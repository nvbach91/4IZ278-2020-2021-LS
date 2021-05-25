<?php require __DIR__ . '/incl/header.php' ?>
<?php require __DIR__ . '/incl/navbar.php' ?>
<?php
require 'components/userRequired.php';

if (isset($_SESSION['orderSent'])) {
    header('Location: ../sp-vavl03/index.php');
    exit();
}
?>
<div class="container order-methods">
    <form action="components/storeOrderMethods.php" method="POST">
        <div class="row order-methods-row">
            <div class="col-12">
                <h2>Delivery method:</h2>
                <div class="select-box">
                    <select class="form-select form-select-lg mb-3" name="delivery" id="delivery-method">
                        <option value="personalCollection" <?= isset($_SESSION['delivery']) && $_SESSION['delivery'] == 'personalCollection' ? ' selected="selected"' : '' ?>>Personal collection</option>
                        <option value="homeDelivery" <?= isset($_SESSION['delivery']) && $_SESSION['delivery'] == 'homeDelivery' ? ' selected="selected"' : ''; ?>>Home delivery (+$3)</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <h2>Payment method:</h2>
                <div class="select-box">
                    <select class="form-select form-select-lg mb-3" name="payment" id="payment-method">
                        <option value="bankTransfer" <?= isset($_SESSION['payment']) && $_SESSION['payment'] == 'bankTransfer' ? ' selected="selected"' : ''; ?>>Bank transfer</option>
                        <option value="cashOnHomeDelivery" <?= isset($_SESSION['payment']) && $_SESSION['payment'] == 'cashOnHomeDelivery' ? ' selected="selected"' : ''; ?>>Cash on delivery (+$1)</option>
                        <option value="cashOnPersonalCollection" <?= isset($_SESSION['payment']) && $_SESSION['payment'] == 'cashOnPersonalCollection' ? ' selected="selected"' : ''; ?>>Cash on personal collection</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="delivery-btns">
            <a href="cart.php" class="btn btn-secondary btn-lg">Back</a>
            <input class="btn btn-primary btn-lg" type="submit" value="Next"></input>
        </div>

    </form>
</div>
<?php require __DIR__ . '/incl/footer.php' ?>

<script src="js/orderMethods.js"></script>