<?php

// used to send mails
define('SERVER_USER_NAME', 'vavl03');

// the address of the sender
$sender = SERVER_USER_NAME . '@vse.cz';

// associative array to keep email templates
$emailTemplates = [
    'headers' => [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/' . phpversion()
    ],
    'Registration confirmation' => function ($recipient) {
        return ("<h2>Registration confirmation</h2>" .
            "<p>Thank you for signing up!</p>" .
            "<h4>You registered email:</h4>" .
            "<p><a href='mailto:$recipient'>$recipient</a></p>");
    },
    'Order confirmation' => function () {
        return ("<h2>Order confirmation</h2>" .
            "<p>Thank you for your order!</p>" .
            "<h4>You can see your orders in My orders section!</h4>" .
            "<a href='https://eso.vse.cz/~vavl03/sp-vavl03/my_orders.php'>Go to My Orders</a>");
    },

];

function sendEmail($recipient, $subject)
{
    // access variables from outside using keyword global
    global $emailTemplates;
    $headers = implode("\r\n", $emailTemplates['headers']);
    $message = $emailTemplates[$subject]($recipient);
    return mail($recipient, $subject, $message, $headers);
};
