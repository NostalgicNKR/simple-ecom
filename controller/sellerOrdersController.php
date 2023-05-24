<?php
require_once("connectionController.php");
require_once("redirectController.php");
require_once("flashController.php"); 
require_once("../functions.php"); 


function ordersOfMyProducts($user_id) {
	global $con;
	$statement = $con->prepare("SELECT * FROM orders WHERE product_id IN(SELECT id FROM products WHERE seller_id = (SELECT id FROM sellers WHERE user_id = ?)) ORDER BY id DESC");
	$statement->bind_param("i", $user_id);
	$statement->execute();
	$data = $statement->get_result();
	$result = $data->fetch_all(MYSQLI_ASSOC);
	return $result;
	
}

function viewOrderOfMyProduct($unique_order_id, $user_id) {
	global $con;
	$statement = $con->prepare("SELECT * FROM orders WHERE id = ? AND product_id IN(SELECT id FROM products WHERE seller_id = (SELECT id FROM sellers WHERE user_id = ?))");
	$statement->bind_param("ii", $unique_order_id, $user_id);
	$statement->execute();
	$data = $statement->get_result();
	$result = $data->fetch_all(MYSQLI_ASSOC);
	return $result[0];
	
}

function updateOrderOfMyProduct($unique_order_id, $updateValue) {
	global $orderStatus;
	global $con;
	$statement = $con->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
	$statement->bind_param("ii", $updateValue, $unique_order_id);
	$statement->execute();
	setFlash("Status changed to $orderStatus[$updateValue] successfully", "success");
	redirect($_SERVER['HTTP_REFERER']);
}

if(isset($_GET['page']) && $_GET['page'] == 'ordered-items.php') {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$ordersOfMyProducts = ordersOfMyProducts($user_id);
}

if(isset($_GET['page']) && $_GET['page'] == 'view-order.php') {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$orderedProduct = viewOrderOfMyProduct($_GET['unique-order-id'], $user_id);
}

if(isset($_POST['shipped'])) {
	updateOrderOfMyProduct($_POST['id'], 1);
	
}
if(isset($_POST['cancel'])) {
	updateOrderOfMyProduct($_POST['id'], 5);
}
if(isset($_POST['Delivered'])) {
	updateOrderOfMyProduct($_POST['id'], 2);
}