<?php
include("connectionController.php");
include("redirectController.php");
include("flashController.php");

class Login {
	
	private $email;
	private $password;
	
	public function __construct($email, $password) {
		$this->email = $email;
		$this->password = $password;
	}
	
	public function verifyUser() {
		global $con;
		if($statement = $con->prepare("SELECT id, username, email, password, role FROM users WHERE email = ?")) {
			$statement->bind_param("s", $this->email);
			$statement->execute();
			$statement->store_result();
			
			//if there is only one user, then proceed to retrieve data
			if($statement->num_rows == 1) {
				//Bind result to proceed verifying data
				$statement->bind_result($id, $username, $email, $hash_password, $role);
				if($statement->fetch()) {
					
					//If correct Password, proceed to log in
					if(password_verify($this->password, $hash_password)) {
						
						if(session_id() == '') {
							session_start();
						}
						//Redirect based on the role of the user
						if($role == 1) {
							$_SESSION['buyer_id'] = $this->getBuyerId($id);
							$_SESSION['Authid'] = $role . '#' . $id;
							$_SESSION['user_id'] = $this->getBuyerId($id);
							$_SESSION['username'] = $username;
							redirect("../customer/");
						} elseif($role == 2) {
							$_SESSION['seller_id'] = $this->getSellerId($id);
							$_SESSION['Authid'] = $role . '#' . $id;
							$_SESSION['username'] = $username;
							redirect("../seller/");
						}					

					} else {
						
						//Flash Incorrect Password
						setFlash("Incorrect Password", "error");
						redirect("../login.php");
					}
					
				}
				
				
			} else {
				//Flash Incorrect email or Password
				setFlash("Cannot find account", "error");
				redirect("../login.php");
			}
			
		$statement->close();
		} else {
			//Flash Internal error
			echo "internal error";
		}
		
	}
	
	public function getSellerId($id) {
		global $con;
		$st = $con->prepare("SELECT id FROM sellers where user_id = ?");
		$st->bind_param("i", $id);
		$st->execute();
		$st->store_result();
		if($st->num_rows == 1) {
			$st->bind_result($seller_id);
			if($st->fetch()) {
				return $seller_id;
			}
		}
	}
	
	public function getBuyerId($id) {
		global $con;
		$st = $con->prepare("SELECT id FROM buyers where user_id = ?");
		$st->bind_param("i", $id);
		$st->execute();
		$st->store_result();
		if($st->num_rows == 1) {
			$st->bind_result($buyer_id);
			if($st->fetch()) {
				return $buyer_id;
			}
		}
	}
	
}

$user = new Login($_POST['email'], $_POST['password']);
$user->verifyuser();