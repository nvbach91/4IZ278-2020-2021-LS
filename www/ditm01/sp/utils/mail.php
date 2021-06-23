<?php 

class Mail {

    function sendContactMail($name, $email, $message) {
        $recepient = 'ditm01@vse.cz';
        $mailSubject = $name . ' has a question';
        $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html, charset=utf-8',
        'From: ' . $email,
        'Reply-To: ' . $email,
        'X-Mailer: PHP/8.0',
        ];
    return mail($recepient, $mailSubject, $message, implode("\r\n", $headers));
    }
}

?>