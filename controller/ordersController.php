<?php
require_once("connectionController.php");
require_once("redirectController.php");
require_once("flashController.php"); 
if(session_id() == "") {
	session_start();
}

function addOrder($customer_id, $order_id, $product_id, $product_name, $product_image, $quantity, $customer_name, $shipping_address, $phone_no, $payment_type, $item_price, $total_amount, $payment_details) {
	global $con;
	$statement = $con->prepare("INSERT INTO orders(customer_id, order_id, product_id, product_name, product_image, quantity, customer_name, shipping_address, phone_no, payment_type, item_price, total_amount, payment_details) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$statement->bind_param("isississsiiis", $customer_id, $order_id, $product_id, $product_name, $product_image, $quantity, $customer_name, $shipping_address, $phone_no, $payment_type, $item_price, $total_amount, $payment_details);
	$statement->execute();
	setFlash("Order placed successfully", "success");
}

function getOrderDetails($order_id) {
	global $con;
	$statement = $con->prepare("SELECT order_id, shipping_address, payment_type, payment_details, ordered_date FROM orders WHERE order_id = ? LIMIT 1");
	$statement->bind_param("s", $order_id);
	$statement->execute();
	$data = $statement->get_result();
	$result = $data->fetch_all(MYSQLI_ASSOC);
	return $result[0];
}

function viewOrder($unique_order_id, $user_id) {
	global $con;
	$statement = $con->prepare("SELECT * FROM orders WHERE id = ? AND customer_id = ?");
	$statement->bind_param("ii", $unique_order_id, $user_id);
	$statement->execute();
	$data = $statement->get_result();
	$result = $data->fetch_all(MYSQLI_ASSOC);
	return $result[0];
}

function getMyOrders($user_id) {
	global $con;
	$statement = $con->prepare("SELECT * FROM orders WHERE customer_id = ? ORDER BY id DESC");
	$statement->bind_param("i", $user_id);
	$statement->execute();
	$data = $statement->get_result();
	$result = $data->fetch_all(MYSQLI_ASSOC);
	return $result;
	
}

function updateMyOrder($unique_order_id, $updateValue) {
	global $con;
	$statement = $con->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
	$statement->bind_param("ii", $updateValue, $unique_order_id);
	$statement->execute();
	if($updateValue == 4) {
	setFlash("Order cancelled successfully", "success");
	}
	if($updateValue == 5) {
	setFlash("Return requested successfully", "success");
	}
	redirect($_SERVER['HTTP_REFERER']);
}

function clearCart($user_id) {
	global $con;
	$emptyString = "";
	$statement = $con->prepare("UPDATE buyers SET cart = ? WHERE user_id = ?");
	$statement->bind_param("si", $emptyString, $user_id);
	$statement->execute();
}

function generateRandomOrderID() {
	$rid = rand(pow(10, 8-1), pow(10, 8)-1);
	global $con;
	$statement = $con->prepare("SELECT order_id FROM orders WHERE order_id = ?");
	$statement->bind_param("s", $rid);
	$statement->execute();
	$statement->store_result();
	if($statement->num_rows > 0) {
		generateRandomOrderID();
	}
	return "OK".$rid;
}

if(isset($_GET['page']) && $_GET['page'] == 'order-success.php') {
	$orderSuccessData = getOrderDetails($_GET['order_id']);
}

if(isset($_GET['page']) && $_GET['page'] == 'orders.php') {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$ordersData = getMyOrders($user_id);
}

if(isset($_GET['page']) && $_GET['page'] == 'manage-order.php') {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$viewOrderData = viewOrder($_GET['unique-order-id'], $user_id);
}

if(isset($_POST['cancel'])) {
	updateMyOrder($_POST['id'], 4);
}
if(isset($_POST['return'])) {
	updateMyOrder($_POST['id'], 3);
}