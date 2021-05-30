<?php

// DB STUFF
const DB_HOST = 'localhost';
const DB_DATABASE = 'podj00';
const DB_USERNAME = 'podj00';
const DB_PASSWORD = ''; //nenahrát na git

define('SERVER_USER_NAME', 'podj00');
$sender = SERVER_USER_NAME . '@vse.cz';

$emailTemplates = [
    'headers' => [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/' . phpversion()
    ],
    'Registration confirmation' => function ($recipient) {
        return (
            "<h2>Potvrzení registrace</h2>" .
            "<p>Děkujeme, že využíváte našich služeby.</p>" .
            "<h4>Registrovaný email:</h4>" .
            "<p><a href='mailto:$recipient'>$recipient</a></p>" .
            "<h4>Toto je automatick generovaná zpráva, neodpovídejte prosím.</h4>"
        );
    },
    'Lesson registered' => function ($recipient) {
        return (
            "<h2>Potvrzení registrace</h2>" .
            "<p>Úspěšně jste se přihlásil na lekci.</p>" .
            "<h4>Toto je automatick generovaná zpráva, neodpovídejte prosím.</h4>"
        );
    },
];
?>