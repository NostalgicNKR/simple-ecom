<?php
require_once("connectionController.php");
require_once("redirectController.php");
require_once("flashController.php"); 
require_once("ordersController.php");
if(session_id() == "") {
	session_start();
}

function getAddress($user_id) {
	global $con;
	$statement = $con->prepare("SELECT shipping_address FROM buyers WHERE user_id = ?");
	$statement->bind_param("i", $user_id);
	$statement->execute();
	$data = $statement->get_result();
	$address = $data->fetch_all(MYSQLI_ASSOC);
	return explode("#",$address[0]['shipping_address']);
}


function updateAddress($user_id) {
	global $con;
	$fullAddress = $_POST['shipping-address']."#".$_POST['state']."#".$_POST['zip-code'];
	$statement = $con->prepare("UPDATE buyers SET shipping_address = ? WHERE user_id = ?");
	$statement->bind_param("si",$fullAddress, $user_id);
	$statement->execute();
}




//Store 111, XYZ street, COLONY#StateName#ZIPCODE
if(isset($_GET['page']) && ($_GET['page'] == "checkout.php")) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$address = getAddress($user_id);	
}

if(isset($_POST['shipping-address'])) {
	//$user_id = explode("#", $_SESSION['Authid'])[1];
	//updateAddress($user_id);
}


if(isset($_POST['completePayment'])) {
	$product_data = unserialize($_POST["product_data"]);
	$customer_id = explode("#", $_SESSION['Authid'])[1];
	$order_id = generateRandomOrderID();
	$shipping_address = $_POST['shipping-address']."#".$_POST['state']."#".$_POST['zip-code'];
	$phone_no = $_POST['phone-no'];
	$usernameForOrder = $_POST['username'];
	//$payment_type = $_POST['payment_type'];
	$payment_type = $_POST['payment-method'];
	$payment_details = isset($_POST['upi-id']) ? $_POST['upi-id'] : '';
	updateAddress($customer_id);
	foreach($product_data as $product) {
		addOrder($customer_id, $order_id, $product['product_id'], $product['product_name'], $product['product_image'], $product['product_quantity'] , $usernameForOrder, $shipping_address, $phone_no, $payment_type, $product['discounted_price'], $product['product_quantity']*$product['discounted_price'], $payment_details);		
	}
	clearCart($customer_id);
	redirect($base_url."customer?page=order-success.php&order_id=$order_id");
}