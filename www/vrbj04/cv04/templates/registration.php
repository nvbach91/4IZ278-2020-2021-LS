<?php

/**
 * @var array $violations
 */

use cv04\src\utilities\Html; ?>

<?php
$root = "..";
require __DIR__ . "/layout/_header.php";
?>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4>Registration</h4>
                <hr>
                <form action="./registration.php" method="post">
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input id="username" type="text" name="username"
                               class="form-control <?= Html::errorClass("username", $violations) ?>"
                               value="<?= Html::value("username", $_POST) ?>">
                        <?= Html::error("username", $violations) ?>
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email"
                               class="form-control <?= Html::errorClass("email", $violations) ?>"
                               value="<?= Html::value("email", $_POST) ?>">
                        <?= Html::error("email", $violations) ?>
                    </div>

                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password"
                               class="form-control <?= Html::errorClass("password", $violations) ?>">
                        <?= Html::error("password", $violations) ?>
                    </div>

                    <div class="form-group mb-2">
                        <label for="password_confirmation">Password confirmation</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="form-control <?= Html::errorClass("password_confirmation", $violations) ?>">
                        <?= Html::error("password_confirmation", $violations) ?>
                    </div>

                    <hr>

                    <button class="btn btn-block btn-spicy">Submit</button>
                </form>

            </div>

            <div class="card-footer">
                <a href="login.php">I already have an account</a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . "/layout/_footer.php"; ?>
