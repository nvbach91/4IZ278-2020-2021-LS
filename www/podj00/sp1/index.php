<?php require __DIR__ . '/includes/head.php'; ?>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<?php require __DIR__ . '/database/repositories/CoachRepository.php' ?>
<?php

?>
    <main class="container-fluid" id="mainHome">
        <div class="row justify-content-md-center formHeight">
            <div class="row text-center">
                <div class="wrapper">
                    <div class="welcomeText">
                        <h1>
                            Vítejte na stránkách Fictive Fitness!
                        </h1>
                        <h3>
                            Jsme firma, která nabízí rezervační systém do Vašich oblíbených gymů.
                            Vyberte si!
                        </h3>
                        <div class="row text-center welcomeRow">
                            <button class="btn btn-outline-primary text-white buttonRadius"><a
                                        class="gymList" href="gym">Seznam
                                    dostupných gymů <i class="fas fa-compress-arrows-alt"></i></a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include __DIR__ . '/includes/foot.php' ?>