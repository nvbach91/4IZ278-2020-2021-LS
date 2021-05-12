<?php

// nenahravat username a password, ani dbname na git!
const DB_HOST = 'localhost';
const DB_DATABASE = 'test';
const DB_USERNAME = 'podj00';
const DB_PASSWORD = '';

// used to send mails
define('SERVER_USER_NAME', 'podj00');

// the address of the sender
$sender = SERVER_USER_NAME . '@vse.cz';

// login page URL
define('PAGE_LOGIN', 'login.php');

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
            "<p>Thank you for signing up!</p>" .
            "<h4>You registered email:</h4>" .
            "<p><a href='mailto:$recipient'>$recipient</a></p>"
            // .
            //"<p>You can now sign in here: <a href='" . PAGE_LOGIN . "'>" . PAGE_LOGIN . "</a></p>"
        );
    },
];

?>