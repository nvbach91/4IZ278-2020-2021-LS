<?php
if(isset($_POST["btn_reset_pass"]))
{
    if(isset($_POST["email"]))
    {
        if(CheckEmail($_POST["email"]))
        {
            $email = $_POST["email"];
            $new_password = randomPassword();
            $password_hash = hash('sha256',$new_password);
            include ('model/pdo.php');
            $sql = "UPDATE users SET pass = ? WHERE email = ?";
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param("ss",$password_hash, $email);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            $to      = $email;
            $subject = 'Noter - new password';
            $message = 'Hello, your new password is:'.$new_password;
            $headers = 'From: noter@noter.com' . "\r\n" .
            'Reply-To: noter@noter.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
        }
        else
        {
            $error_msg = "This email does not exist in our database.";
        }
    }
    else
    {
        $error_msg = "You have to write your email.";
    }
}