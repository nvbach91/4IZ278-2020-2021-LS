<?php require_once __DIR__ . '/../includes/utils/baseHelper.php'; ?>
<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php

if (!isset($_COOKIE['user'])) {
    header("Location: " . BASE_URL . "login.php");
    die();
}

verifyUserAccess(PRIVILEGE_ADMINISTRATOR);

$prague = new DateTime(null, new DateTimeZone("Europe/Prague"));
$london = new DateTime(null, new DateTimeZone("Europe/London"));
$newYork = new DateTime(null, new DateTimeZone("America/New_York"));
$sydney = new DateTime(null, new DateTimeZone("Australia/Sydney"));
$singapore = new DateTime(null, new DateTimeZone("Asia/Singapore"));


?>
<?php include __DIR__ . '/../header.php'; ?>
<?php include __DIR__ . '/../navigation.php'; ?>

<div class="container py-5">

    <h1>Administrace</h1>

    <ul class="nav nav-pills mb-3">
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo BASE_URL . "admin/"; ?>">Produkty</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo BASE_URL . "admin/users.php"; ?>">Uživatelé</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href="<?php echo BASE_URL . "admin/world-clock.php"; ?>">Hodiny</a>
        </li>
    </ul>

    <div class="mt-4 vh-100">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Město</th>
                    <th scope="col">Čas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Praha</th>
                    <td><?php echo $prague->format("d.m.Y H:i:s P"); ?></td>
                </tr>
                <tr>
                    <th scope="row">Londýn</th>
                    <td><?php echo $london->format("d.m.Y H:i:s P"); ?></td>
                </tr>
                <tr>
                    <th scope="row">New York</th>
                    <td><?php echo $newYork->format("d.m.Y H:i:s P"); ?></td>
                </tr>
                <tr>
                    <th scope="row">Sydney</th>
                    <td><?php echo $sydney->format("d.m.Y H:i:s P"); ?></td>
                </tr>
                <tr>
                    <th scope="row">Singapore</th>
                    <td><?php echo $singapore->format("d.m.Y H:i:s P"); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<?php include __DIR__ . '/../footer.php'; ?>
