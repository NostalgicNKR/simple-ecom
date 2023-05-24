<?php
require_once("connectionController.php");
require_once("redirectController.php");
require_once("flashController.php"); 
if(session_id() == "") {
	session_start();
}

function getProfileDetails($id) {
	global $con;
	$statement = $con->prepare("SELECT id, username, email, phone, password FROM users WHERE id = ?");
	$statement->bind_param("i", $id);
	$statement->execute();
	$data = $statement->get_result();
	$profileData = $data->fetch_all(MYSQLI_ASSOC);
	return $profileData[0];
}
	
function getBuyerData($id) {
	global $con;
	$statement = $con->prepare("SELECT * FROM buyers WHERE user_id = ?");
	$statement->bind_param("i", $id);
	$statement->execute();
	$data = $statement->get_result();
	$buyerData = $data->fetch_all(MYSQLI_ASSOC);
	return $buyerData[0];
}

function updateProfileDetails($id, $username, $phone, $address, $state, $zipCode) {
	global $con;
	$statement = $con->prepare("UPDATE users SET username = ?, phone = ? WHERE id = ?");
	$statement->bind_param("ssi",$username, $phone, $id);
	$statement->execute();	
	updateBuyerDetails($address, $state, $zipCode, $id);
	setFlash("Profile updated successfully", "success");
	redirect($_SERVER["HTTP_REFERER"]);
}

function updateBuyerDetails($address, $state, $zipCode, $id) {
	global $con;
	$fullAddress = $address."#". $state."#".$zipCode;
	$statement = $con->prepare("UPDATE buyers SET shipping_address = ? WHERE user_id = ?");
	$statement->bind_param("si", $fullAddress, $id);
	$statement->execute();
}
	
function changePassword() {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	//get old password hash first and store
	$updatePassword = getProfileDetails($user_id)['password'];
	//echo $updatePassword;
	//If user try to reset password, verify hash 
	if(isset($_POST['currentPassword'])) {
		
		$currentPassword = $_POST['currentPassword'];
		//Verifying against old hash and entered password
		if($_POST['newPassword'] != $_POST['confirmPassword']) {
			setFlash("Passwords are not same", "danger");
			redirect($_SERVER['HTTP_REFERER']);
		}
		if(password_verify($currentPassword, $updatePassword)) {
			//If correct, hash and store password
			$updatePassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
			global $con;
			$statement = $con->prepare("UPDATE users SET password = ? WHERE id = ?");
			$statement->bind_param("si",$updatePassword, $user_id);
			$statement->execute();	
			setFlash("Password Changed Successfullly", "success");
		} else {
			setFlash("Incorrect Password", "error");
			//redirect("../seller/?page=profile.php");	
			//exit();
			//
			
			//	
		}
	} else {
	setFlash("Fill required details", "error");
	
	}		
	
	
}
if(isset($_GET['page']) && ($_GET['page'] == "profile.php")) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$profileData = getProfileDetails($user_id);
	$buyerData = getBuyerData($user_id);
}

if(isset($_POST['email'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	updateProfileDetails($user_id, $_POST['username'], $_POST['phone-no'], $_POST['shipping-address'], $_POST['state'], $_POST['zip-code']);
}

if(isset($_POST['changePassword'])) {
	changePassword();
	redirect($_SERVER["HTTP_REFERER"]);
}

if(isset($_GET['page']) && ($_GET['page'] == "checkout.php")) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$profileDataForCheckout = getProfileDetails($user_id);

}