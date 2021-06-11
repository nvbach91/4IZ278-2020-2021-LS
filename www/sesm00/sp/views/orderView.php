<?php include __DIR__ . '/../components/header.php'; ?>
<?php include __DIR__ . '/../components/navigation.php'; ?>
<?php ?>
<div class="min-vh-100 position-relative page-container">
    <div class="container py-2">
        <h1 class="mb-4">Objednávka</h1>
        <?php include __DIR__ . '/../components/errorPrinter.php'; ?>
        <form method="post">
            <div class="mb-4">
                <h3>Doručení</h3>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" id="inputFirstname" class="w-100 mb-2 form-control" placeholder="Jméno" name="firstname"<?php if ($this->dataSent && isset($_POST['firstname'])): ?> value="<?php echo $_POST['firstname']; ?>" <?php endif; ?>/>
                        <label class="sr-only" for="inputFirstname">Jméno</label>
                        <input type="text" id="inputCity" class="w-100 mb-2 form-control" placeholder="Město" name="city"<?php if ($this->dataSent && isset($_POST['city'])): ?> value="<?php echo $_POST['city']; ?>" <?php endif; ?>/>
                        <label class="sr-only" for="inputCity">Město</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="inputLastname" class="w-100 mb-2 form-control" placeholder="Příjmení" name="lastname"<?php if ($this->dataSent && isset($_POST['lastname'])): ?> value="<?php echo $_POST['lastname']; ?>" <?php endif; ?>/>
                        <label class="sr-only" for="inputLastname">Příjmení</label>
                        <input type="text" id="inputZip" class="w-100 mb-2 form-control" placeholder="PSČ" name="zip"<?php if ($this->dataSent && isset($_POST['zip'])): ?> value="<?php echo $_POST['zip']; ?>" <?php endif; ?>/>
                        <label class="sr-only" for="inputZip">PSČ</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="inputStreet" class="w-100 mb-2 form-control" placeholder="Ulice" name="street"<?php if ($this->dataSent && isset($_POST['street'])): ?> value="<?php echo $_POST['street']; ?>" <?php endif; ?>/>
                        <label class="sr-only" for="inputStreet">Ulice</label>
                        <input type="text" id="inputPhone" class="w-100 mb-2 form-control" placeholder="Telefon" name="phone"<?php if ($this->dataSent && isset($_POST['phone'])): ?> value="<?php echo $_POST['phone']; ?>" <?php endif; ?>/>
                        <label class="sr-only" for="inputPhone">Telefon</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <h3>Způsob dopravy</h3>
                    <div>
                        <div class="card mb-2 js-card-option pointer-cursor">
                            <div class="card-header px-4">
                                <div class="d-flex align-items-center custom-control custom-radio">
                                    <input class="mt-0 custom-control-input js-card-input" type="radio" id="delivery-ceskaposta" checked="checked" name="deliveryType" value="1"/>
                                    <label class="mb-0 custom-control-label" for="delivery-ceskaposta">Česká pošta</label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2 js-card-option pointer-cursor">
                            <div class="card-header px-4">
                                <div class="d-flex align-items-center custom-control custom-radio">
                                    <input class="mt-0 custom-control-input js-card-input" type="radio" id="delivery-zasilkovna" name="deliveryType" value="2"/>
                                    <label class="mb-0 custom-control-label" for="delivery-zasilkovna">Zásilkovna</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <h3>Platební metoda</h3>
                    <div>
                        <div class="card mb-2 js-card-option pointer-cursor">
                            <div class="card-header px-4">
                                <div class="d-flex align-items-center custom-control custom-radio">
                                    <input class="mt-0 custom-control-input js-card-input" type="radio" id="payment-method-card" checked="checked" name="paymentMethod" value="1"/>
                                    <label class="mb-0 custom-control-label" for="payment-method-card">Kartou</label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2 js-card-option pointer-cursor">
                            <div class="card-header px-4">
                                <div class="d-flex align-items-center custom-control custom-radio">
                                    <input class="mt-0 custom-control-input js-card-input" type="radio" id="payment-method-wire" name="paymentMethod" value="2"/>
                                    <label class="mb-0 custom-control-label" for="payment-method-wire">Bankovním převodem</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Produkty</h3>
            <div class="mb-3 order-products overflow-auto">
                <?php foreach ($this->cart->getProducts() as $prodKey => $product) : ?>
                    <?php if ($product->type == 2) : ?>
                        <div class="py-2">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="my-0">Dálniční známka - <?php echo htmlspecialchars($product->name); ?></h5>
                                        </div>
                                        <div class="col text-right">
                                            <strong class="text-danger"><?php echo $product->getFormatedPrice() . " " . CURRENCY; ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-1">
                                    <div class="row">
                                        <div class="col-md-4 py-2">
                                            <input type="text" class="form-control form-control-sm" name="fields[<?php echo $prodKey; ?>][spz]" placeholder="SPZ" />
                                        </div>
                                        <div class="col-md-4 py-2">
                                            <select class="custom-select custom-select-sm" name="fields[<?php echo $prodKey; ?>][state]">
                                                <option class="d-none" selected>Vyberte zemi</option>
                                                <?php foreach ($this->states as $state) : ?>
                                                    <option value="<?php echo $state->getId(); ?>"><?php echo $state->code . " - " . $state->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 text-right"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="py-2">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="my-0"><?php echo htmlspecialchars($product->name); ?></h5>
                                        </div>
                                        <div class="col text-right">
                                            <strong class="text-danger"><?php echo $product->getFormatedPrice() . " " . CURRENCY; ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="text-right mb-5">
                <strong class="d-block">Celkem: <?php echo formatPrice($this->cart->getCartTotal()) . " " . CURRENCY; ?></strong>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="agreeWithTerms">
                    <label class="custom-control-label" for="customCheck1">Souhlasím s obchodními podmínkami</label>
                </div>
                <input type="hidden" name="fields[]" value="">
                <button class="btn btn-primary d-inline-block mt-2" type="submit">Odeslat objednávku</button>
            </div>
        </form>
    </div>

    <div class="position-absolute absolute-bottom w-100">
        <?php include __DIR__ . '/../components/footer.php'; ?>
    </div>
</div>
