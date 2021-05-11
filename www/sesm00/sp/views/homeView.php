<?php include __DIR__ . '/../components/header.php'; ?>
<?php include __DIR__ . '/../components/navigation.php'; ?>


    <div class="container">
        <h1>Česká dálnice CZ</h1>

        <?php foreach ($cartMsgs as $msg) : ?>
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <?php echo $msg; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endforeach; ?>

        <?php require 'views/sliderView.php'; ?>


        <?php //require 'views/productView.php'; ?>

        <div>
            <div class="mt-2">
                <h2>Osobní vozy</h2>
                <div class="row">
                    <div class="col-4 px-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">1 ROK</h4>
                                <p class="card-text">1 500 Kč</p><button class="btn btn-primary w-100" type="button">Přidat do košíku</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 px-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">30 DNÍ</h4>
                                <p class="card-text">440 Kč</p><button class="btn btn-primary w-100" type="button">Přidat do košíku</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 px-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">10 DNÍ</h4>
                                <p class="card-text">310 Kč</p><button class="btn btn-primary w-100" type="button">Přidat do košíku</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <h2>Nákladní vozy</h2>
                <div class="row">
                    <div class="col-4 px-2 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Razer 2000</h4>
                                <p class="card-text">Zařízení pro nákladní vozy do 4 náprav. Zařízení je kompatibilní se systémem v ČR</p><strong class="mb-3 d-block">2 500 Kč</strong><button class="btn btn-primary w-100" type="button">Přidat do košíku</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 px-2 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Razer 3000</h4>
                                <p class="card-text">Zařízení pro nákladní vozy do 8 náprav. Zařízení je kompatibilní se systémem v ČR<br /></p><strong class="d-block mb-3">3 700 Kč</strong><button class="btn btn-primary w-100" type="button">Přidat do košíku</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 px-2 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Rymer 800</h4>
                                <p class="card-text">Zařízení pro nákladní vozy do 8 náprav. Zařízení je kompatibilní se systémem v D a A<br /></p><strong class="d-block mb-3">7 200 Kč</strong><button class="btn btn-primary w-100" type="button">Přidat do košíku</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 px-2 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cerko system 8</h4>
                                <p class="card-text">Zařízení pro nákladní vozy do 8 náprav. Zařízení je kompatibilní se systémem v PL<br /></p><strong class="d-block mb-3">6 800 Kč</strong><button class="btn btn-primary w-100" type="button">Přidat do košíku</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php include __DIR__ . '/../components/footer.php'; ?>