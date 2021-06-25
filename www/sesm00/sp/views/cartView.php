<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarCart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Košík
    </a>
    <div class="dropdown-menu px-2 navbar-cart" aria-labelledby="navbarCart">
        <?php foreach ($this->cartProducts as $cartKey => $cartProduct) : ?>
            <div class="row mb-1">
                <div class="col-8 pt-1">
                    <?php echo $cartProduct->name; ?>
                </div>
                <div class="col-4 text-right">
                    <form method="post">
                        <input type="hidden" name="action" value="removeFromCart">
                        <input type="hidden" name="id" value="<?php echo $cartKey; ?>">
                        <input type="submit" class="btn btn-sm btn-danger" value="x">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="dropdown-divider"></div>
        <div class="text-right">
            <?php echo formatPrice($this->cart->getCartTotal()) . " " . CURRENCY; ?>
        </div>
        <?php if (count($this->cartProducts) > 0) : ?>
            <div class="mt-2">
                <a href="order" class="btn btn-primary w-100">K objednávce</a>
            </div>
        <?php endif; ?>
    </div>
</li>