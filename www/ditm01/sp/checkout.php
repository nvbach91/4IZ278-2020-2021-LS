<?php require __DIR__ . '/db/productsDB.php'; ?>
<?php require __DIR__ . '/db/ordersDB.php'; ?>
<?php require __DIR__ . '/db/usersDB.php'; ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$productsDB = new ProductsDB();
$ordersDB = new OrdersDB();
$usersDB = new UsersDB();

$ids = @$_SESSION['cart'];
$user_id = @$_SESSION['user_id'];
$invalidInputs = [];

if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';
    $products = $productsDB->fetchCartProducts($question_marks, $ids);
    $priceTotal = $productsDB->sumPrice($question_marks, $ids);
}

if (isset($_SESSION['user_email'])) {
    $user_email = @$_SESSION['user_email'];
    $existing_user = $usersDB->findUser($user_email);
    $user_phone = $existing_user['phone'];
    if ($user_phone == 0) {
        $user_phone = '';
    }
}

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = trim($_POST['address']);
    $zip = trim($_POST['zip']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $phone = trim($_POST['phone']);
    $delivery = $_POST['delivery'];
    $payment = $_POST['payment'];

    //validace

    if (empty($invalidInputs)) {
        $deliveryInfo = array(
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'zip' => $zip,
            'city' => $city,
            'country' => $country,
            'phone' => $phone,
            'delivery' => $delivery,
            'payment' => $payment,
            'total_price' => $priceTotal,
            'date' => date("Y-m-d H:i:s"),
        );
        $_SESSION['deliveryInfo'] = $deliveryInfo;
        header('Location: Order');
    }
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container container--cart">
    <div class=" mb-2 text-center">
        <h1>Order</h1>
    </div>
    <a class="btn btn-primary mb-5" href="cart.php" role="button">Back to cart</a>
    <div class="main-container">
        <section class="cart">
            <?php if ($products) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <th scope="row"><img class="cart-thumbnail" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"></th>
                                <td><?php echo $product['name'] ?></td>
                                <td><?php echo $product['price'], ' ', CURRENCY; ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th scope="row" colspan="2">Total:</th>
                            <td><?php echo $priceTotal, ' ', CURRENCY; ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
        <section class="order-form_section form-section">
            <div class=" mb-2 text-center">
                <h2>Delivery Info</h2>
            </div>
            <?php foreach ($invalidInputs as $invalidInput) : ?>
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div><?php echo $invalidInput; ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endforeach; ?>
            <form class="row g-3 sign-form popup-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputName" class="col-form-label">Name</label>
                    </div>
                    <div class="col-auto">
                        <input name="name" type="text" id="inputName" class="form-control" value="<?php echo ($existing_user) ? $existing_user['name'] : '' ?>" placeholder="John Smith">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputEmail" class="col-form-label">Email</label>
                    </div>
                    <div class="col-auto">
                        <input name="email" type="email" id="inputEmail" class="form-control" value="<?php echo ($existing_user) ? $existing_user['email'] : '' ?>" placeholder="email@example.com">
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputAddress" class="col-form-label">Address</label>
                    </div>
                    <div class="col-auto">
                        <input name="address" type="text" id="inputAddress" class="form-control" value="<?php echo ($existing_user) ? $existing_user['address'] : '' ?>" placeholder="nám. Winstona Churchilla 1938/4">
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputZip" class="col-form-label">ZIP</label>
                    </div>
                    <div class="col-auto">
                        <input name="zip" type="text" id="inputZip" class="form-control" value="<?php echo ($existing_user) ? $existing_user['zip'] : '' ?>" placeholder="130 67">
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputCity" class="col-form-label">City</label>
                    </div>
                    <div class="col-auto">
                        <input name="city" type="text" id="inputCity" class="form-control" value="<?php echo ($existing_user) ? $existing_user['city'] : '' ?>" placeholder="Praha">
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputCountry" class="col-form-label">Country</label>
                    </div>
                    <div class="col-auto">
                        <input name="country" type="text" id="inputCountry" class="form-control" value="<?php echo ($existing_user) ? $existing_user['country'] : '' ?>" placeholder="Czechia">
                    </div>
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputPhone" class="col-form-label">Phone</label>
                    </div>
                    <div class="col-auto">
                        <input name="phone" type="text" id="inputPhone" class="form-control" value="<?php echo $user_phone; ?>" placeholder="111 222 333">
                    </div>
                </div>
                <div class="order_popup-container">
                    <div class="popup-radio_wrapper">
                        <label class="popup-radio_title">Delivery method:</label>
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
                        <label class="popup-radio_title">payment method:</label>
                        <div class="popup-radio_input">
                            <div class="popup-input popup-input_radio">
                                <input type="radio" name="payment" id="payment_card" value="card" checked>
                                <label for="payment_card">credit card</label>
                            </div>

                            <div class="popup-input popup-input_radio">
                                <input type="radio" name="payment" id="payment_cash" value="cash">
                                <label for="payment_cash">cash on delivery</label>
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
                            <td class="cart-td cart-td--price"><strong><?php echo $priceTotal, ' ', CURRENCY; ?></strong></td>
                            <td class="cart-td"></td>
                        </tr>
                    </table>
                </section>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Order</button>
                </div>
            </form>
        </section>

    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>