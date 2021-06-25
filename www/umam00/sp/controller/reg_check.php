<?php
    if (isset($_POST["btn_reg"]))
    {
        if (isset($_POST["name"]) and isset($_POST["password"]) and isset($_POST["email"]) and isset($_POST["password_check"]))
        {
            if ($_POST["password"] == $_POST["password_check"])
            {
                if(passValid($_POST["password"]))
                {
                    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                    {
                        $email=$_POST["email"];
                        include('model/email_ver.php');
                        if ($data)
                        {
                            $error_msg = "This email is already in use.";
                            $email = null;
                            $stmt->close();
                            $conn->close();
                        }
                        else
                        {
                            include('model/user_insert.php');
                            include('controller/reset_page.php');
                        }
                    }
                    else
                    {
                        $error_msg = "Email format is incorrect.";
                    }

                }
                else
                {
                    $error_msg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";

                }
            }
            else {
                $error_msg = "Passwords have to match.";
            }
        }
    }
?>