<?php 

require __DIR__ . '/utils/utils.php';

$email = $_GET['email'];
$user = fetchUser($email);

if (!$user) {
    header('Location: login.php');
    exit();
}

?>

<?php require __DIR__ . '/incl/header.php'; ?>

<main class="container">
    <br>
    <h1 class="text-center">Your profile</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Your name: <?php echo $user['name']; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Your email: <?php echo $user['email']; ?></h6>
            <p class="card-text"><?php echo file_get_contents('http://loripsum.net/api/1/short/plaintext'); ?></p>
        </div>
    </div>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>