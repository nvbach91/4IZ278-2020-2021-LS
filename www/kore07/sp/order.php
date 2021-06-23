<?php require_once __DIR__ . '/components/checkLoggedUser.php'; ?>
<?php require_once __DIR__ . '/components/saveUserInfo.php'; ?>
<?php require_once __DIR__ . '/components/getUser.php'; ?>
<?php require_once __DIR__ . '/database/ProductsDB.php'; ?>

<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productsDB = new ProductsDB();

    $products = [];
    $count = 0;
    $ids = [];

    foreach ($_SESSION['cart'] as $key=>$value) {
        array_push($ids, $_SESSION['cart'][$key]['id']);
    }

    if (is_array($ids) && count($ids)) {
        $question_marks = str_repeat('?,', count($ids) - 1) . '?';

        $products = $productsDB->fetchAllByOrder('product_id', $question_marks, $ids);
        $sum = $productsDB->fetchColumn('product_price * product_quantity', 'product_id', $question_marks, $ids);
        $count = $productsDB->fetchColumn('product_quantity', 'product_id', $question_marks, $ids);
    }

    $isSubmitted = (!empty($_POST) && ('POST' == $_SERVER['REQUEST_METHOD']));

    if ($isSubmitted) {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $address = trim(@$_POST['address']);
        $zip = trim(@$_POST['zip']);
        $city = trim(@$_POST['city']);
        $country = trim(@$_POST['country']);
        $phone = trim(@$_POST['phone']);
        $delivery = $_POST['delivery'];
        $payment = $_POST['payment'];

        $orderInfo = array(
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'zip' => $zip,
            'city' => $city,
            'country' => $country,
            'phone' => $phone,
            'delivery' => $delivery,
            'payment' => $payment,
            'total' => $sum,
            'date' => date("Y-m-d H:i:s"),
        );

        $_SESSION['order_info'] = $orderInfo;

        header('Location: components/placeOrder.php');
    }

?>

<?php require __DIR__ . '/includes/header.php' ?>


<main class="container container--cart">
    <div class="main-container">
        <h1 class="main-heading">Order</h1>
    </div>
    <div class="cart-info_wrapper">
        <div class="main-container cart-info_wrapper--inner">
            <a class="cart-back_link" href="cart.php">Back to cart</a>
            <p class="cart-total_products"> Total products selected: <?php echo $count; ?> </p>
        </div>
    </div>
    <div class="main-container">
        <section class="cart">
            <h2 class="visually-hidden">Order list</h2>
            <?php if ($products): ?>
                <div class="products-wrapper">
                    <table class="cart-table">
                    <?php foreach ($products as $product): ?>
                        <tr class="cart-tr">
                            <td class="cart-td cart-td--image">
                                <img class="cart-image" src="<?php echo $product['product_img']; ?>"/>
                            </td>            
                            <td class="cart-td cart-td--name">
                                <?php echo $product['product_name']; ?>
                            </td>            
                            <td class="cart-td cart-td--quantity">
                                <?php echo $product['product_quantity']; ?>
                            </td>            
                            <td class="cart-td cart-td--price">
                                <?php echo number_format($product['product_price'], 2), ' ', GLOBAL_CURRENCY; ?>
                            </td>            
                            <td class="cart-td cart-td--remove">
                                <a class="cart-remove_link" href='components/removeItem.php?id=<?php echo $product['product_id']; ?>' aria-label="Remove"></a>
                            </td>            
                        </tr>
                        <?php endforeach; ?>
                        <tr class="cart-tr cart-tr--total">
                            <td class="cart-td"></td>
                            <td class="cart-td"></td>
                            <td class="cart-td cart-td--name cart-td--name_total">Total: </td>
                            <td class="cart-td cart-td--price"><strong><?php echo number_format($sum, 2), ' ', GLOBAL_CURRENCY; ?></strong></td>
                            <td class="cart-td"></td>
                        </tr>
                    </table>
                </div>
                
            <?php endif; ?>
        </section>
        <section class="order-form_section form-section">
            <h2 class="popup-title">Order Info</h2>
            <form class="sign-form popup-form" method="post">
                <div class="order_popup-container">
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
                            value="<?php echo ($existing_user) ? $existing_user['user_email'] : '' ?>" 
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
                </div>
                <div class="order_popup-container">
                    <div class="popup-radio_wrapper">
                        <label class="popup-radio_title">Order delivery:</label>
                        <div class="popup-radio_input">
                            <div class="popup-input popup-input_radio">
                                <input type="radio" name="delivery" id="delivery_standard" value="standard">
                                <label for="delivery_standard">Standard Delivery</label>
                            </div>

                            <div class="popup-input popup-input_radio">
                                <input type="radio" name="delivery" id="delivery_express" value="express" checked>
                                <label for="delivery_express">Express Delivery</label>
                            </div>
                        </div>
                    </div>
                    <div class="popup-radio_wrapper">
                        <label class="popup-radio_title">Order payment:</label>
                        <div class="popup-radio_input">
                            <div class="popup-input popup-input_radio">
                                <input type="radio" name="payment" id="payment_card" value="card" checked>
                                <label for="payment_card">Pay with credit card now</label>
                            </div>

                            <div class="popup-input popup-input_radio">
                                <input type="radio" name="payment" id="payment_cash" value="cash">
                                <label for="payment_cash">Pay in cash on delivery</label>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="total-price">
                    <table class="cart-table">
                        <tr class="cart-tr cart-tr--total">
                            <td class="cart-td"></td>
                            <td class="cart-td"></td>
                            <td class="cart-td cart-td--name cart-td--name_total">Total: </td>
                            <td class="cart-td cart-td--price"><strong><?php echo number_format($sum, 2), ' ', GLOBAL_CURRENCY; ?></strong></td>
                            <td class="cart-td"></td>
                        </tr>
                    </table>                    
                </section>
                <button type="submit" class="order-link button popup-button">Place order</button>
            </form>
        </section>
                
    </div>
</main>


<?php require __DIR__ . '/includes/footer.php' ?>
