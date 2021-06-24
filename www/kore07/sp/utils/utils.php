<?php 

    require_once __DIR__ . '/../config/config.php';

    function sendEmail($recipient, $subject) {
        global $emailTemplates;
        $headers = implode("\r\n", $emailTemplates['headers']);
        $message = $emailTemplates[$subject]($recipient);
        return mail($recipient, $subject, $message, $headers);
    };


    function validate($args) {
        $errors = [];

        if (!filter_var($args['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a validni email';
        }

        if (strlen($args['address']) <= 1) {
            $errors['address'] = 'Please enter a validni address. It cannot be too short';
        }

        if (strlen($args['city']) <= 1) {
            $errors['city'] = 'Please enter a validni city. It cannot be too short';
        }

        if (strlen($args['country']) <= 1) {
            $errors['country'] = 'Please enter a validni country. It cannot be too short';
        }

        if (!preg_match('/\d/', $args['zip'])) {
            $errors['zip'] = 'Please enter a validni zip. It should be numbers';
        }

        if (!preg_match('/[0-9]{3}-[0-9]{3}-[0-9]{4}/', $args['phone'])) {
            $errors['phone'] = 'Please enter a validni phone number. In format 111-222-3333';
        }

        return $errors;
    }
?>
