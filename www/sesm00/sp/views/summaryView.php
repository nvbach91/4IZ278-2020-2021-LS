<?php include __DIR__ . '/../components/header.php'; ?>
<?php include __DIR__ . '/../components/navigation.php'; ?>
<?php

$delivery_name = "Neznámý";
$payment_name = "Neznámá";

if ($this->order->payment_method == 1) {
    $payment_name = "Karta";
} else if ($this->order->payment_method == 2) {
    $payment_name = "Bankovní převod";
}

if ($this->order->delivery_type == 1) {
    $delivery_name = "Česká pošta";
} else if ($this->order->delivery_type == 2) {
    $delivery_name = "Zásilkovna";
}

?>
<div class="min-vh-100 position-relative page-container">
    <div class="container py-2">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mb-4">Shrnutí</h1>
                <h4 class="mb-4">Objednávka byla úspěšně vytvořena a <?php if ($this->order->payed == 1) : ?>zaplacena<?php else : ?>není zaplacena<?php endif; ?></h4>
            </div>
            <div class="col-md-6">
                <?php if ($this->order->payed == 1) : ?>
                    <div class="pt-2 text-center summary-check-icon text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                <?php else : ?>
                    <div class="pt-2 text-center summary-check-icon text-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <form method="post">
            <div class="mb-4">
                <h3>Detail</h3>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <td>
                                    <strong>
                                        Jméno<br>
                                        Příjmení<br>
                                        Ulice<br>
                                        Město<br>
                                        PSČ<br>
                                        Telefon<br>
                                        Způsob dopravy<br>
                                        Platební metoda
                                    </strong>
                                </td>
                                <td class="px-4">
                                    <?php echo htmlspecialchars($this->address->firstname); ?><br>
                                    <?php echo htmlspecialchars($this->address->lastname); ?><br>
                                    <?php echo htmlspecialchars($this->address->street); ?><br>
                                    <?php echo htmlspecialchars($this->address->city); ?><br>
                                    <?php echo htmlspecialchars($this->address->zip); ?><br>
                                    <?php echo htmlspecialchars($this->address->phone); ?><br>
                                    <?php echo $payment_name; ?><br>
                                    <?php echo $delivery_name; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <h3>Produkty</h3>
            <div class="mb-3 order-products overflow-auto">
                <?php foreach ($this->products as $prodKey => $product) : ?>
                    <?php
                        $baseProduct = $product->getBaseProduct();
                        $productField = $product->getProductField();
                    ?>
                    <?php if ($productField != false) : ?>
                        <div class="py-2">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="my-0">Dálniční známka - <?php echo htmlspecialchars($baseProduct->name); ?></h5>
                                        </div>
                                        <div class="col text-right">
                                            <strong class="text-danger"><?php echo formatPrice($product->unit_price * $product->quantity) . " " . CURRENCY; ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-1">
                                    <div class="row">
                                        <div class="col-md-4 py-2">
                                            <strong>SPZ</strong> <?php echo htmlspecialchars($productField->registration_plate); ?>
                                        </div>
                                        <div class="col-md-4 py-2">
                                            <strong>Příslušný stát</strong> <?php echo htmlspecialchars($productField->getState()->name); ?>
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
                                            <h5 class="my-0"><?php echo htmlspecialchars($baseProduct->name); ?></h5>
                                        </div>
                                        <div class="col text-right">
                                            <strong class="text-danger"><?php echo formatPrice($product->unit_price * $product->quantity) . " " . CURRENCY; ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="text-right mb-5">
                <strong class="d-block">Celkem: <?php echo formatPrice($this->order->total) . " " . CURRENCY; ?></strong>
            </div>
        </form>
    </div>

    <div class="position-absolute absolute-bottom w-100">
        <?php include __DIR__ . '/../components/footer.php'; ?>
    </div>
</div>
