<?php

/**
 * @var array $violations
 */

use cv05\src\utilities\Html; ?>

<?php
$root = "..";
require __DIR__ . "/layout/_header.php";
?>

<div class="row">
<?php if (isset($_GET["successfully-registered"])): ?>
    <h1 class="alert text-success">
        Successfully registered!
    </h1>
<?php endif; ?>
    <div class="col-sm-12"></div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4>Login</h4>
                <hr>
                <form action="./login.php" method="post">
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email" class="form-control <?= Html::errorClass("email", $violations) ?>"
                               value="<?= Html::value("email", $_POST) ?>">
                        <?= Html::error("email", $violations) ?>
                    </div>

                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-control <?= Html::errorClass("password", $violations) ?>">
                        <?= Html::error("password", $violations) ?>
                    </div>

                    <hr>

                    <button class="btn btn-block btn-spicy">Submit</button>
                </form>
            </div>

            <div class="card-footer">
                <a class="card-link" href="registration.php">Register a new account</a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . "/layout/_footer.php"; ?>
