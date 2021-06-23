<?php require_once __DIR__ . '/components/saveUserInfo.php'; ?>
<?php require_once __DIR__ . '/components/getUser.php'; ?>

<?php
    if(!isset($_SESSION)){
        session_start();
    }

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
            $picture = $fb->get('/me/picture?redirect=false&height=200')->getGraphUser();

            $response = $fb->get('/me?fields=name,email');
            $userNode = $response->getGraphUser();
            
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($_SESSION['user_id'])) {
            $existing_user = array(
                'user_name' => $me->getName(),
                'user_email' => $userNode->getField('email'),
                'user_hashedPassword' => '',
                'user_address' => '',
                'user_zip' => '',
                'user_city' => '',
                'user_country' => '',
                'user_phone' => '',
            );

            $_SESSION['user_id'] = $me->getId();
            $_SESSION['user_email'] = $userNode->getField('email');

            $usersDB->create($existing_user);
        }
    }  
?>

<?php require __DIR__ . '/includes/header.php' ?>
<main class="container">
    <div class="main-container">
        <section class="order-form_section form-section">
            <h1 class="popup-title">Profile Info</h1>
            <form class="sign-form popup-form" method="post">
                <p class="popup-input">
                    <label for="user_name">Name:</label>
                    <input 
                            type="text" 
                            class="" 
                            name="name" 
                            id="user_name" 
                            placeholder="Lisa Tompson" 
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
                        type="text" 
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
                    <label for="user_phone">Phone:</label>
                    <input 
                        type="tel" 
                        class="" 
                        name="phone" 
                        id="user_phone" 
                        placeholder="+1 22 2222 3333" 
                        value="<?php echo ($existing_user) ? $existing_user['user_phone'] : '' ?>" 
                        required>
                </p>

                <button class="button popup-button" type="submit">Save</button>
            </form>
        </section>
    </div>
</main>
<?php require __DIR__ . '/includes/footer.php' ?>
