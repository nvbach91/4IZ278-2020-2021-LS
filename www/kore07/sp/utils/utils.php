<?php 

    require_once __DIR__ . '/../config/config.php';

    function sendEmail($recipient, $subject) {
        global $emailTemplates;
        $headers = implode("\r\n", $emailTemplates['headers']);
        $message = $emailTemplates[$subject]($recipient);
        return mail($recipient, $subject, $message, $headers);
    };

?>
