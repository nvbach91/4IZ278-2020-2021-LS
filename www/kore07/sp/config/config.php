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
        'Confirmation' => function ($recipient) {
            return (
                "<h2>Confirmation</h2>" .
                "<p>Thank you!</p>" .
                "<h4>You registered email:</h4>" .
                "<p><a href='mailto:$recipient'>$recipient</a></p>"
            );
        },
    ];
?>