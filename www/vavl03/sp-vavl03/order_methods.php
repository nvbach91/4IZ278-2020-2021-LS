<?php require __DIR__ . '/incl/header.php' ?>
<?php require __DIR__ . '/incl/navbar.php' ?>
<?php
require 'components/userRequired.php'; // pristup jen pro prihlaseneho uzivatele
// check if user just sent order, if yes, redirect him to home page to start new order
if (isset($_SESSION['orderSent'])) {
    echo ($_SESSION['orderSent']);
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
                    <select class="form-select form-select-lg mb-3" name="payment">
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

<script>
    console.log(<?php echo (json_encode($_SESSION)) ?>);
    // enable/disable options
    if ($('#delivery-method').val() === 'homeDelivery') {
        $("option[value='cashOnPersonalCollection']").attr("disabled", "disabled");
    }
    if ($('#delivery-method').val() === 'personalCollection') {
        $("option[value='cashOnHomeDelivery']").attr("disabled", "disabled");
    }

    $('#delivery-method').on('change', function() {
        console.log($(this).val());
        if ($(this).val() === 'personalCollection') {
            $("option[value='cashOnHomeDelivery']")
                .attr("disabled", "disabled").siblings().removeAttr("disabled");
        } else if ($(this).val() === 'homeDelivery') {
            $("option[value='cashOnPersonalCollection']")
                .attr("disabled", "disabled").siblings().removeAttr("disabled");
        }
    });
</script>