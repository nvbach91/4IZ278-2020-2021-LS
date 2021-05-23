<?php require_once __DIR__ . '/class/PaymentDB.php'; ?>
<?php require_once __DIR__ . '/class/ShippingDB.php'; ?>
<?php require_once __DIR__ . '/class/ProductsDB.php'; ?>
<?php

$paymentsDB = new PaymentDB();
$payments = $paymentsDB->fetchAll();

$shippingsDB = new ShippingDB();
$shippings = $shippingsDB->fetchAll();
$productsDB = new ProductsDB();

if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {

	$product_id = (int) htmlspecialchars($_POST['product_id']);
	$quantity = (int) htmlspecialchars($_POST['quantity']);


	$product = $productsDB->fetchByProdPost();

	if ($product && $quantity > 0) {
		// Product exists in database, now we can create/update the session variable for the cart
		if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
			if (array_key_exists($product_id, $_SESSION['cart'])) {
				// Product exists in cart so just update the quanity
				$_SESSION['cart'][$product_id] += $quantity;
			} else {
				// Product is not in cart so add it
				$_SESSION['cart'][$product_id] = $quantity;
			}
		} else {
			// There are no products in cart, this will add the first product to cart
			$_SESSION['cart'] = array($product_id => $quantity);
		}
	}
	header('location: index.php?page=cart');
	exit;
}

if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
	header('Location: index.php?page=checkout');
	exit;
}


$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;


if ($products_in_cart) {
	$array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
	$products = $productsDB->fetchByArray($array_to_question_marks);

	foreach ($products as $product) {
		$subtotal += (float) $product['price'] * (int) $products_in_cart[$product['product_id']];
	}
}

$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$total = $subtotal;

$msg = '';
$msgClass = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$valid = false; 

	if (filter_has_var(INPUT_POST, 'submit')) {
		$firstName = htmlspecialchars(trim($_POST['first-name']));
		$lastName = htmlspecialchars(trim($_POST['last-name']));
		$email = htmlspecialchars(trim($_POST['email']));
		$address = htmlspecialchars(trim($_POST['address']));
		$city = htmlspecialchars(trim($_POST['city']));
		$country = htmlspecialchars(trim($_POST['country']));
		$zip = htmlspecialchars(trim($_POST['zip-code']));
		$phone = htmlspecialchars(trim($_POST['tel']));

		$_SESSION['shipping']=htmlspecialchars(trim($_POST['shipping']));
		$_SESSION['payment']=htmlspecialchars(trim($_POST['shipping']));
		if(!empty($_POST['detail'])){
			$_SESSION['detail']=htmlspecialchars(trim($_POST['detail']));
		}
	
		
		

		if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($address) && !empty($city) && !empty($country) && !empty($zip) &&  !empty($phone)) {
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false ||  !preg_match('"\A\S+@\S+\Z"', $email)) {
				$valid = false;
				$msg = "Invalid email.";
				$msgClass = 'alert-danger';
			} elseif (!preg_match("/^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/", $phone)) {
				$valid = false;
				$msg = "Invalid phone number!";
				$msgClass = 'alert-danger';
			} elseif (!preg_match('"\d{5}"', $zip)) {
				$valid = false;
				$msg = '"Invalid zip-code!"';
				$msgClass = 'alert-danger';
			} elseif (!preg_match('"^\D*$"', $firstName) || !preg_match('"^\D*$"', $lastName)) {
				$valid = false;
				$msg = "First name or last name cannot contain a number!";
				$msgClass = 'alert-danger';
			} else {
				$valid = true;
				$_SESSION['firstName'] = $firstName;
				$_SESSION['lastName'] = $lastName;
				$_SESSION['email'] = $email;
				$_SESSION['address'] = $address;
				$_SESSION['city'] = $city;
				$_SESSION['country'] = $country;
				$_SESSION['zip'] = $zip;
				$_SESSION['phone'] = $phone;
				if($_POST['password']){
					$_SESSION['password']=htmlspecialchars(trim($_POST['password']));
				}
		
				header('Location: index.php?page=placeorder');

			}
		} else {
			$valid = false;
			$msg = "Please fill in all fields.";
			$msgClass = 'alert-danger';
		}
	}
}
?>

<?php include __DIR__ . '/includes/header.php' ?>

<div class="section">
	<div class="container">
		<div class="row">
			<?php if ($msg != '') : ?>
				<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>

			<?php endif; ?>
			<form  method="POST">
				<div class="col-md-7">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">Billing address</h3>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="first-name" placeholder="First Name*" value="<?php echo isset($_POST['first-name']) ? $firstName : ''; ?>" required>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="last-name" placeholder="Last Name*" value="<?php echo isset($_POST['last-name']) ? $lastName : ''; ?>" required>
						</div>
						<div class="form-group">
							<?php if (isset($_SESSION['user_email']) || isset($_SESSION['access_token'])) : ?>
								<input class="input" type="hidden" name="email" placeholder="Email*" required value="<?php echo $_SESSION['user_email']; ?>">
							<?php elseif (isset($_SESSION['user_data'])) : ?>
								<input class="input" type="hidden" name="email" placeholder="Email*" required value="<?php echo $_SESSION['userData']['email']; ?>">
							<?php else : ?>
								<input class="input" type="email" name="email" placeholder="Email*" required value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
							<?php endif; ?>

						</div>
						<div class="form-group">
							<input class="input" type="text" name="address" placeholder="Address*" required value="<?php echo isset($_POST['address']) ? $address : ''; ?>">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="city" placeholder="City*" required value="<?php echo isset($_POST['city']) ? $city : ''; ?>">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="country" placeholder="Country*" required value="<?php echo isset($_POST['country']) ? $country : ''; ?>">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="zip-code" placeholder="ZIP Code*" required value="<?php echo isset($_POST['zip-code']) ? $zip : ''; ?>">
						</div>
						<div class="form-group">
							<input class="input" type="tel" name="tel" placeholder="Telephone*" required value="<?php echo isset($_POST['tel']) ? $phone : ''; ?>">
						</div>
						<div class="form-group">
							<?php if (isset($_SESSION['user_id']) || isset($_SESSION['access_token'])) : ?>
							<?php else : ?>
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Create Account?
									</label>
									<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<div class="shiping-details">

						<div class="input-checkbox">
							<input type="checkbox" id="shiping-address">
						</div>
					</div>

					<div class="order-notes">
						<textarea style="resize: none;" name="detail" class="input" placeholder="Order Notes"></textarea>
					</div>
				</div>

				<div class="col-md-5 order-details">
					<div class="section-title text-center">
						<h3 class="title">Your Order</h3>
					</div>
					<div class="order-summary">
						<div class="order-col">
							<div><strong>PRODUCT</strong></div>
							<div style="text-align:right"><strong>PRICE</strong></div>
							<div><strong>TOTAL</strong></div>
						</div>

						<div class="order-products">
							<?php foreach ($products as $product) : ?>
								<div class="order-col">
									<div><?= $products_in_cart[$product['product_id']] ?>x <?php echo $product["name"]; ?></div>
									<div style="text-align:right"><?= $product["price"] ?> CZK</div>
									<?php $totalCheckoutPerItem = ($product["price"] * $products_in_cart[$product['product_id']]); ?>
									<div><?php echo $totalCheckoutPerItem; ?> CZK</div>
								</div>

							<?php endforeach; ?>

							<div class="order-col">
								<div><strong>TOTAL FOR PRODUCTS</strong></div>
								<div><strong class="order-total"><?= $subtotal ?> CZK</strong></div>
							</div>
						</div>

						<div class="payment-method">
							<div class="section-title text-center">
								<h3 class="title">Payment method</h3>
							</div>
							<div class="order-col">
								<div><strong>PAYMENT</strong></div>
								<div><strong>PRICE</strong></div>
							</div>
							<?php foreach ($payments as $payment) : ?>
								<div class="order-col">
									<div>
										<input required type="radio" name="payment" id="<?php echo $payment['payment_id']; ?>" value="<?php echo $payment['payment_id']; ?>">
										<label style="margin-bottom:0;" required for="payment-<?php echo $payment['payment_id']; ?>">
											<?php echo $payment['name'] ?>

										</label>
									</div>
									<div style="text-align:right"><?= $payment["price"] ?> CZK</div>

								</div>

							<?php endforeach; ?>
						</div>


						<div>
							<div class="section-title text-center">
								<h3 class="title">Shipping method</h3>
							</div>
							<div class="order-col">
								<div><strong>SHIPPING</strong></div>
								<div><strong>PRICE</strong></div>
							</div>
							<?php foreach ($shippings as $shipping) : ?>

								<div class="order-col">
									<div>
										<input required type="radio" name="shipping" id="<?php echo $shipping['shipping_id']; ?>" value="<?php echo $shipping['shipping_id']; ?>">
										<label style="margin-bottom:0;" required for="shipping-<?php echo $shipping['shipping_id']; ?>">
											<?php echo $shipping['name'] ?>
										</label>


									</div>
									<div style="text-align:right"><?= $shipping["price"] ?> CZK</div>
								</div>

							<?php endforeach; ?>
						</div>
					</div>


					<div>
						<input type="checkbox" required>
						<label for="terms">
							<span></span>
							I've read and accept the <a href="#">Terms & Conditions</a>
						</label>
						<input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">

						<input type="submit" name="submit" class="button-red" value="Place order">
					</div>
					<div class="order-btn">

					</div>
				</div>
			</form>
		</div>
	</div>
</div>



<?php include __DIR__ . '/includes/newsletter.php' ?>

<?php include __DIR__ . '/includes/footer.php' ?>