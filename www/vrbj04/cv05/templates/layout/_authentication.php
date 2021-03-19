<?php

use cv05\src\authentication\Authentication;
use cv05\src\utilities\Html;

$authentication = $authentication ?? new Authentication();

?>

<div class="navbar navbar-expand-lg bg-dark dark rounded-lg px-5">
    <?php if ($authentication->check()): ?>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= $root ?? "." ?>/admin/users.php">Registered users</a>
            </li>
        </ul>
    <?php endif; ?>

    <ul class="navbar-nav" style="margin-left: auto;">
        <?php if ($authentication->check()): ?>
            <li class="nav-item">
                <small class="text-muted">Logged in as</small>
                <b class="spicy ml-1"><?= Html::sanitize($authentication->user()->username) ?></b>
            </li>
    </ul>
    <ul class="navbar-nav" style="margin-left: 10px">
        <li class="nav-item">
            <a class="nav-link" href="<?= $root ?? "." ?>/auth/logout.php">Logout</a>
        </li>
    </ul>
    <ul class="navbar-nav">
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $root ?? "." ?>/auth/login.php">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= $root ?? "." ?>/auth/registration.php">Registration</a>
            </li>
        <?php endif; ?>
    </ul>
</div>