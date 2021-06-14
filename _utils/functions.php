<?php
function sendEmail($recipient, $subject, $message) {
$headers = [
'MIME-Version: 1.0',
'Content-type: text/html, charset=utf-8',
'From: app@dev.com',
'Reply-To: app@dev.com',
'X-Mailer: PHP/8.0',
];
$msg = "
<h1>Registration confirmation</h1>
<p>$message</p>
";
return mail($recipient, $subject, $msg, implode("\r\n", $headers));
}
?>