<?php

$errors = [];

require __DIR__ . '/utils/utils.php';

$isSubmitted = !empty($_POST);
if ($isSubmitted) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $authentication = authenticate($email, $password);
    if (!$authentication['success']) {
        $errors['authentication'] = $authentication['msg'];
    } else {
        header('Location: profile.php?email=' . $email);
        exit();
    }
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

?>

<?php include __DIR__ . '/includes/header.php'; ?>
<main>
    <?php include __DIR__ . '/includes/navigation.php'; ?>
    <h1>Login</h1>
    <form method="POST">
        <?php if (isset($_GET['email']) && @$_GET['ref'] === 'registration') : ?>
            <div>Woohoo! You have successfully signed up!</div>
        <?php endif; ?>
        <?php if ($isSubmitted && !empty($errors)) : ?>
            <div>
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <div>
            <label>Email*</label>
            <input name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div>
            <label>Password*</label>
            <input name="password" type="password">
        </div>
        <button type="submit">Submit</button>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>