<?php
require_once("connectionController.php");
require_once("redirectController.php");
require_once("flashController.php"); 

function forceSellerToAddDetails($id) {
	global $con;
	$companyname = getSellerData($id)['company_name'];
	if(empty($companyname) || !isset($companyname)) {
		setFlash("Add company name and address to proceed", "warning");
		redirect("../seller/?page=profile.php");
	} 
}


function getStats($user_id, $orderStatus) {
	global $con;
	$statement = $con->prepare("SELECT count(id) AS `stats` FROM orders WHERE product_id IN (SELECT id FROM products WHERE seller_id = (SELECT id FROM sellers where user_id = ?)) AND order_status = ?");
	$statement->bind_param("ii", $user_id, $orderStatus);
	$statement->execute();
	$statement->store_result();
	$statement->bind_result($stats);
		if($statement->fetch()) {
			return $stats;
		}

}

function getTotalEarnings($user_id, $orderStatus) {
	global $con;
	$count = count($orderStatus);
	$placeholders = implode(',', array_fill(0, $count, '?'));
	$bindStr = str_repeat('i', $count+1);
	
	$statement = $con->prepare("SELECT sum(total_amount) AS `stats` FROM orders WHERE product_id IN (SELECT id FROM products WHERE seller_id = (SELECT id FROM sellers where user_id = ?)) AND order_status IN ($placeholders)");
	$statement->bind_param($bindStr, $user_id, ...$orderStatus);
	$statement->execute();
	$statement->store_result();
	$statement->bind_result($stats);
		if($statement->fetch()) {
			return $stats;
		}

}


if((isset($_GET['page']) && $_GET['page'] == 'stats.php') || !isset($_GET['page'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$ordersData = array();
	for($x = 0; $x < 6; $x++) {
		array_push($ordersData,getStats($user_id , $x));
	}
	$totalEarnings = getTotalEarnings($user_id, [2]);
	$pendingEarnings = getTotalEarnings($user_id, [0,1]);
	$onlyConfirmedEarnings = getTotalEarnings($user_id, [0]);
	$onlyShippedEarnings = getTotalEarnings($user_id, [1]);
}
