<?php 

require_once __DIR__ . '/config/config.php';

include __DIR__ . '/partials/header.php';
include __DIR__ . '/navigation.php';

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code']))
{
 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 {
  $access_token = $facebook_helper->getAccessToken();

  $_SESSION['access_token'] = $access_token;
  $_SESSION['admin'] = false;

  $facebook->setDefaultAccessToken($_SESSION['access_token']);
 }

 $_SESSION['user_id'] = '';
 $_SESSION['user_name'] = '';
 $_SESSION['user_email'] = '';
 $_SESSION['user_image'] = '';

 $graph_response = $facebook->get("/me?fields=name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();

 if(!empty($facebook_user_info['id']))
 {
  $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
 }

 if(!empty($facebook_user_info['name']))
 {
  $_SESSION['user_name'] = $facebook_user_info['name'];
 }

 if(!empty($facebook_user_info['email']))
 {
  $_SESSION['user_email'] = $facebook_user_info['email'];
 }
 
}
else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('https://eso.vse.cz/~palt04/sp-palt04/login.php', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="php-login-with-facebook.gif" /></a></div>';
}

if (isset($_SESSION['access_token'])) {
    header('Location: index.php');
}


$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';

$submittedForm = !empty($_POST);
if ($submittedForm) {
    $email = @$_POST['email'];
    $password = @$_POST['password'];

    $stmt = $connect->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([
        'email' => $email
    ]);
    $existing_user = @$stmt->fetchAll()[0];

    if (empty($existing_user)) {
        array_push($alertMessages, "User with this email does not exist");
    }
    else if (@password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['user_id'];
        $_SESSION['user_email'] = $existing_user['email'];
        $_SESSION['admin'] = $existing_user['privilege'] == 1 ? true : false;

        header('Location: index.php');
    }
    else {
        array_push($alertMessages, "You entered wrong password! Try again.");
    }
}
?>

<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-6">
        <h1 class="center">Login</h1>
        <?php if ($submittedForm): ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
        <?php endif; ?>  
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($email) ? $email : '' ?>">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control<?php echo in_array('password', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($password) ? $password : '' ?>">
                </div>
                <button class="btn btn-info font-weight-bold">Log in</button>
            </form>
            <h3>Or</h3>
            <?php
                if(isset($facebook_login_url))
                {
                echo $facebook_login_url;
                }
            ?>
            <a href="registration.php" class="text-warning">Don't have an account yet? Go to sign up!</a>
        </div>
    </div>
</div>