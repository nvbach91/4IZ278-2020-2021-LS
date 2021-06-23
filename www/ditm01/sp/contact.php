<?php require __DIR__ . '/utils/mail.php'; ?>
<?php
$invalidInputs = [];

$mail = new Mail();

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!$name || !preg_match('/^[a-zA-Z ]*$/', $name)) {
        array_push($invalidInputs, 'Please enter your name');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Please enter valid email address');
    }

    if (empty($invalidInputs)) {
        $mail->sendContactMail($name, $email, $message);
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <div class="text-center mb-2">
        <h2>Contact us</h2>
    </div>
    <?php foreach ($invalidInputs as $invalidInput) : ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
                <?php echo $invalidInput; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <form class="row g-3" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="col-md-6">
            <label for="inputName1" class="form-label">Your name</label>
            <input name="name" type="text" class="form-control" id="inputName1" placeholder="John Example">
        </div>
        <div class="col-md-6">
            <label for="inputEmail1" class="form-label">Your email address</label>
            <input name="email" type="email" class="form-control" id="inputEmail1" placeholder="email@example.com">
        </div>
        <div class="col-md-12">
            <label for="Textarea1" class="form-label">Your message</label>
            <textarea name="message" class="form-control" id="Textarea1" rows="10"></textarea>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>