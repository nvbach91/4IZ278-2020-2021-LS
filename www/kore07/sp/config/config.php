<?php
    const SERVER_USER_NAME = 'kore07';

    $sender = SERVER_USER_NAME . '@vse.cz';

    // associative array to keep email templates
    $emailTemplates = [
        'headers' => [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=utf-8',
            'From: ' . $sender,
            'Reply-To: ' . $sender,
            'X-Mailer: PHP/'.phpversion()
        ],
        'Registration confirmation' => function ($recipient) {
            return (
                "<h2>Registration confirmation</h2>" .
                "<p>Thank you for your registration on the website iDevice!</p>" .
                "<h4>You registered email:</h4>" .
                "<p><a href='mailto:$recipient'>$recipient</a></p>"
            );
        },
        'Order confirmation' => function () {
            return (
                "<h2>Order confirmation</h2>" .
                "<p>Thank you for yor order!</p>"
            );
        },
    ];
?>