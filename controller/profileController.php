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

function getSellerData($id) {
	global $con;
	$statement = $con->prepare("SELECT * FROM sellers WHERE user_id = ?");
	$statement->bind_param("i", $id);
	$statement->execute();
	$data = $statement->get_result();
	$sellerData = $data->fetch_all(MYSQLI_ASSOC);
	return $sellerData[0];
}

function updateProfileDetails($id, $username, $phone) {
	global $con;
	$statement = $con->prepare("UPDATE users SET username = ?, phone = ? WHERE id = ?");
	$statement->bind_param("ssi",$username, $phone, $id);
	$statement->execute();	
	setFlash("Profile Updated Successfully", "success");
	//redirect($_SERVER["HTTP_REFERER"]);
}

function updateSellerData($id) {
	global $con;
	if(isset($_POST['company-name'])) {
		$company_name = $_POST['company-name'];
		$address = $_POST['company-address'];
		$statement = $con->prepare("UPDATE sellers SET company_name = ?, company_address = ? WHERE user_id = ?");
		$statement->bind_param("ssi", $company_name, $address, $id);
		$statement->execute();
		setFlash("Details Updated Successfully", "success");
		redirect($_SERVER["HTTP_REFERER"]);		
	}
	if(isset($_POST['bank-no'])) {
		$bankdata = $_POST['bank-no'] . "," . $_POST['bank-ifsc'];
		$gstin =  $_POST['gstin'];
		$fullName = $_POST['bank-full-name'];
		$statement = $con->prepare("UPDATE sellers SET full_name = ?, bank_details = ?, gstin = ? WHERE user_id = ?");
		$statement->bind_param("sssi",$fullName, $bankdata, $gstin, $id);
		$statement->execute();	
		setFlash("Details Updated Successfully", "success");
		redirect($_SERVER["HTTP_REFERER"]);
	}
	
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

if($loadView = "profile.php") {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$profileData = getProfileDetails($user_id);
	$sellerData = getSellerData($user_id);
}

if($loadView = "bank-details.php") {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$sellerData = getSellerData($user_id);
}

if(isset($_POST['email'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	updateProfileDetails($user_id, $_POST['username'], $_POST['phone']);
	updateSellerData($user_id);
}

if(isset($_POST['updateBankDetails'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	updateSellerData($user_id);
}

if(isset($_POST['changePassword'])) {
	changePassword();
	redirect($_SERVER["HTTP_REFERER"]);
}