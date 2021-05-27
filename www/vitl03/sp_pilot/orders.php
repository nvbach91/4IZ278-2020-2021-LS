<?php require_once __DIR__ . '/class/OrdersDB.php'; ?>
<?php require_once __DIR__ . '/class/UsersDB.php'; ?>
<?php require_once __DIR__ . '/class/PaymentDB.php'; ?>
<?php require_once __DIR__ . '/class/ShippingDB.php'; ?>
<?php



if (isset($_SESSION['userData']['email'])) {
	$userEmail =  $_SESSION['userData']['email'];
} elseif (isset($_SESSION['access_token'])) {
	$userEmail =  $_SESSION['user_email'];
} else {
	$userEmail = $_SESSION['user_email'];
}


$ordersDB = new OrdersDB();
$orders = $ordersDB->fetchAllByEmail($userEmail);



?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/navigationProfile.php' ?>

<div class="container">
	<div class="row">

		<br>
		<h1 style="text-transform:uppercase; text-align:center;">Order detail</h1>
		<br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<td class="table-row">Order ID</td>
					<td class="table-row">Amount</td>
					<td class="table-row">Payment</td>
					<td class="table-row">Shipping</td>
					<td class="table-row">Detail</td>
					<td class="table-row">Date</td>
					<td class="table-row">Order details</td>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($orders)) : ?>
					<tr>
						<td colspan="7" style="text-align:center;">You have no orders.</td>
					</tr>
				<?php else : ?>
					<?php foreach ($orders as $order) : ?>
						<tr>
							<td class="img" style="text-align:center;"><a href="index.php?page=order&id=<? echo $order['order_id']; ?>"></a><?php echo $order['order_id']; ?></td>
							<td style="text-align:center;" class="price"> <?php echo $order['amount']; ?> CZK</td>

							<?php $paymentDB = new PaymentDB();
							$payment  = $paymentDB->fetchById($order['payment_id']); ?>
							<td style="text-align:center;" class="price"><?php echo $payment['name']; ?></td>

							<?php $shippingDB = new ShippingDB();
							$shipping  = $shippingDB->fetchById($order['shipping_id']); ?>
							<td style="text-align:center;"><?php echo $shipping['name']; ?></td>
							<td style="text-align:center;"><?php echo $order['detail']; ?></td>
							<td style="text-align:center;"><?php $newDate = date("d.m.Y H:i", strtotime($order['date']));
															echo $newDate; ?></td>
							<td style="text-align:center;" class="price"><a href="index.php?page=order&id=<?= $order['order_id'] ?>"><i style="font-size: 20px;" class="fa fa-file"></i></a></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>

	</div>

</div>








<?php include __DIR__ . '/includes/newsletter.php' ?>

<?php include __DIR__ . '/includes/footer.php' ?>