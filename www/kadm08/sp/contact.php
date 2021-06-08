<?php
session_start();
$errorMessages = [];

function sendMail($name, $email, $message)
{
    $recepient = 'kadm08@vse.cz';
    $subject = $name . " is sending you a message." ;
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: ' . $email,
        'Reply-To: ' . $email,
        'X-Mailer: PHP/8.0',
    ];
    return mail($recepient, $subject, $message, implode("\r\n", $headers));
}

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!$name || !preg_match('/^[a-zA-Z ]*$/', $name)) {
        array_push($errorMessages, 'Please enter your name');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errorMessages, 'Please enter valid email address');
    }

    if (empty($errorMessages)) {
        sendMail($name, $email, $message);
    }
}
?>


<?php include __DIR__ . '/includes/header.php'; ?>

<br><br>
<div class="container contact-form">
            <form method="POST">
                <h3>Drop Us a Message</h3>
                <?php foreach ($errorMessages as $message) : ?>
                    <p style="color:red;"><?php echo $message; ?></p>
                    <?php endforeach; ?>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Your Name *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" id="text" name="phone" class="form-control" placeholder="Your Phone Number *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btn btn-light px-5  shadow-sm" value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea id="message" name="message" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>