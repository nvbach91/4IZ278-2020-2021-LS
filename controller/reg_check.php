    <?php
    if (isset($_POST["btn_reg"]))
    {
        if (isset($_POST["name"]) and isset($_POST["password"]) and isset($_POST["email"]) and isset($_POST["password_check"]))
        {
            if ($_POST["password"] == $_POST["password_check"])
            {
                if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                {
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
                        header("Location: index.php");
                        exit();
                    }
                }
                else
                {
                    $error_msg = "Email format is incorrect.";
                }
            }
            else {
                $error_msg = "Passwords have to match.";
            }
        }
    }
    ?>