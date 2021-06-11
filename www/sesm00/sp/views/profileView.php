<?php include __DIR__ . '/../components/header.php'; ?>
<?php include __DIR__ . '/../components/navigation.php'; ?>
<?php

    $currentPage = $this->currentPage;
    $pages = array();
    $pageCount = ceil(($this->ordersCount / PRODUCTS_PER_PAGE));

    if ($currentPage != 1) {
        array_push($pages, array('number' => ($currentPage - 1), 'active' => false, 'link' => getCurrentUrl(false) . "?page=" . ($currentPage - 1)));
    }

    array_push($pages, array('number' => $currentPage, 'active' => true, 'link' => getCurrentUrl(false) . "?page=" . $currentPage));

    if ($currentPage != $pageCount) {
        array_push($pages, array('number' => ($currentPage + 1), 'active' => false, 'link' => getCurrentUrl(false) . "?page=" . ($currentPage + 1)));
    }

?>

<div class="min-vh-100 position-relative page-container">
    <div class="container py-2">

        <h1>Objednávky</h1>

        <div class="mt-3">
            <?php foreach ($this->orders as $order) : ?>
                <?php
                    $products = OrderProduct::getProductsByOrderId($order->getId());
                ?>
                <div class="card my-4">
                    <div class="card-header">
                        Objednávka číslo <?php echo htmlspecialchars($order->getId()); ?>
                    </div>
                    <div class="card-body">
                        <?php foreach ($products as $prodKey => $product) : ?>
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

                        <div class="text-right">
                            <strong class="d-block">Celkem: <?php echo formatPrice($order->total) . " " . CURRENCY; ?></strong>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item<?php if ($currentPage == 1) : ?> disabled<?php endif; ?>">
                <a class="page-link" href="<?php echo getCurrentUrl(false) . "?page=" . ($currentPage - 1);?>"<?php if ($currentPage == 1) : ?> aria-disabled="true"<?php endif; ?>>Předchozí</a>
            </li>
            <?php foreach ($pages as $page) : ?>
                <li class="page-item<?php if ($page['active']) : ?> active<?php endif; ?>"><a class="page-link" href="<?php echo $page['link'];?>"><?php echo $page['number'];?></a></li>
            <?php endforeach; ?>
            <li class="page-item<?php if ($currentPage == $pageCount) : ?> disabled<?php endif; ?>">
                <a class="page-link" href="<?php echo getCurrentUrl(false) . "?page=" . ($currentPage + 1);?>"<?php if ($currentPage == $pageCount) : ?> aria-disabled="true"<?php endif; ?>>Další</a>
            </li>
        </ul>
    </nav>

    <div class="position-absolute absolute-bottom w-100">
        <?php include __DIR__ . '/../components/footer.php'; ?>
    </div>

</div>
