<?php
    // multiple recipients
$to = $_POST['mail'];
// subject
$subject = 'Subscription';

// message
$message = '
<html>
<head>
  <title>Thank You For Your Subscription</title>
</head>
<body>
  <p>Here are the news from ACTIVE!</p>
  <table>
    <tr>
      <th>Subject</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>New Promo</td><td>3rd</td><td>August</td><td>2021</td>
    </tr>
    <tr>
      <td>New Item</td><td>17th</td><td>August</td><td>2021</td>
    </tr>
  </table>
  <p>Have a nice day,</p>
  <p>Your Active Team</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// Additional headers
$headers .= 'To: ' . $_POST['mail'] . '' . "\r\n";
$headers .= 'From: Active Team <admin@active.com>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);

header('Location: index.php?page=newsletter');
