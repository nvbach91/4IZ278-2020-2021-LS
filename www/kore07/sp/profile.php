<?php //require_once __DIR__ . '/components/saveUserInfo.php'; ?>
<?php require_once __DIR__ . '/components/getUser.php'; ?>
<?php require_once __DIR__ . '/utils/utils.php'; ?>

<?php
    if(!isset($_SESSION)){
        session_start();
    } 

    $usersDB = new UsersDB();
    $errors = [];
    
    $isSubmitted = (!empty($_POST) && ('POST' == $_SERVER['REQUEST_METHOD']));


    if (!isset($_SESSION['fb_access_token']) && !isset($_SESSION['user_email'])) {
        header('Location: signin.php');
        exit();  
    } 

    if (isset($_SESSION['fb_access_token'])) {
        require_once __DIR__ . '/facebook/vendor/autoload.php';
        require __DIR__ . '/facebook/config.php';

        $fb = new \Facebook\Facebook(array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']]));
        try {
            $me = $fb->get('/me')->getGraphUser();
            $response = $fb->get('/me?fields=name,email');
            $userNode = $response->getGraphUser();
            $email = $userNode->getField('email');
            
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if ($usersDB->fetchBy('user_email', $email)) {
            $existing_user = $usersDB->fetchBy('user_email', $email);

            $_SESSION['user_id'] = $existing_user['user_id'];
            $_SESSION['user_email'] = $email;
        } else {
            $existing_user = array(
                'user_name' => $me->getName(),
                'user_email' => $email,
                'user_hashedPassword' => '',
                'user_address' => '',
                'user_zip' => '',
                'user_city' => '',
                'user_country' => '',
                'user_phone' => '',
            );

            $usersDB->create($existing_user);
            $existing_user = $usersDB->fetchBy('user_email', $email);

            $_SESSION['user_id'] = $existing_user['user_id'];
            $_SESSION['user_email'] = $email;
        }
    }  

    if ($isSubmitted) { 

        $name = trim(@$_POST['name']);
        $email = trim(@$_POST['email']);
        $address = trim(@$_POST['address']);
        $zip = trim(@$_POST['zip']);
        $city = trim(@$_POST['city']);
        $country = trim(@$_POST['country']);
        $phone = trim(@$_POST['phone']);

        $errors = validate($_POST);

        if (empty($errors)) {
            $sets = array(
                'user_name' => $name,
                'user_email' => $email,
                'user_address' => $address,
                'user_zip' => $zip,
                'user_city' => $city,
                'user_country' => $country,
                'user_phone' => $phone,
            );
    
            $wheres = array(
                'user_id' => $_SESSION['user_id'],
            );
    
            $usersDB->updateBy($wheres, $sets);

            header('Location: profile.php');
        }
    };
?>

<?php require __DIR__ . '/includes/header.php' ?>
<main class="container">
    <div class="main-container">
        <section class="order-form_section form-section">
            <h1 class="popup-title">Profile Info</h1>
            <?php if ($isSubmitted && !empty($errors)): ?>
                <div class="popup-alert alert alert-danger">
                    <?php echo implode('<br>', array_values($errors)); ?>
                </div>
            <?php endif; ?>
            <form class="sign-form popup-form" method="post" >
                <p class="popup-input">
                    <label for="user_name">Name:</label>
                    <input 
                            type="text" 
                            class="" 
                            name="name" 
                            id="user_name" 
                            placeholder="Mr Smith" 
                            value="<?php echo ($existing_user) ? $existing_user['user_name'] : '' ?>"
                            required>
                </p>
                <p class="popup-input">
                    <label for="user_email">Email:</label>
                    <input 
                        type="email" 
                        class="" 
                        name="email" 
                        id="user_email" 
                        placeholder="email@email.com" 
                        value="<?php echo ($existing_user['user_email']) ? $existing_user['user_email'] : '' ?>" 
                        required>
                </p>
                <p class="popup-input">
                    <label for="user_address">Address:</label>
                    <input 
                        type="text" 
                        class="" 
                        name="address" 
                        id="user_address" 
                        placeholder="Washington st. 222" 
                        value="<?php echo ($existing_user) ? $existing_user['user_address'] : '' ?>" 
                        required>
                </p>
                <p class="popup-input">
                    <label for="user_zip">ZIP:</label>
                    <input 
                        type="number" 
                        class="" 
                        name="zip" 
                        id="user_zip" 
                        placeholder="55416" 
                        value="<?php echo ($existing_user) ? $existing_user['user_zip'] : '' ?>" 
                        required>
                </p>
                <p class="popup-input">
                    <label for="user_city">City:</label>
                    <input 
                        type="text" 
                        class="" 
                        name="city" 
                        id="user_city" 
                        placeholder="New York" 
                        value="<?php echo ($existing_user) ? $existing_user['user_city'] : '' ?>" 
                        required>
                </p>
                <p class="popup-input">
                    <label for="user_country">Country:</label>
                    <input 
                        type="text" 
                        class="" 
                        name="country" 
                        id="user_country" 
                        placeholder="USA" 
                        value="<?php echo ($existing_user) ? $existing_user['user_country'] : '' ?>" 
                        required>
                </p>
                <p class="popup-input">
                    <label for="user_phone">Phone (111-222-3333):</label>
                    <input 
                        type="tel" 
                        class="" 
                        name="phone" 
                        id="user_phone" 
                        placeholder="Only in format 111-222-3333" 
                        pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                        value="<?php echo ($existing_user) ? $existing_user['user_phone'] : '' ?>" 
                        required>
                </p>

                <button class="button popup-button" type="submit">Save</button>
            </form>
        </section>
    </div>
</main>
<?php require __DIR__ . '/includes/footer.php' ?>
