<?php 

require 'config.php';

function sendEmail($recipient, $subject) {
    // access variables from outside using keyword global
    global $emailTemplates;
    
    $headers = implode("\r\n", $emailTemplates['headers']);
    var_dump($headers);
    var_dump($emailTemplates[$subject]($recipient));
    $message = $emailTemplates[$subject]($recipient);
    return mail($recipient, $subject, $message, $headers);
};
