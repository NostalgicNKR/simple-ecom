<?php 
require_once("connectionController.php");
require_once("redirectController.php");
require_once("flashController.php");


class Signup {
	
	private $username;
	private $password;
	private $email;
	private $role;
	
	public function __construct($username, $password, $email, $role) {
		$this->username = $username;
		$this->setPassword($password);
		$this->email = $email;
		$this->role = $role;
	}
	
	
	public function setPassword($password) {
		global $con;
		if(isset($_POST['password'])) {
			$this->password = mysqli_real_escape_string($con, $_POST['password']);
			$this->password = password_hash($password, PASSWORD_DEFAULT);
		}
	}
	
	public function insertUser() {
		
		global $con;
		if($stmt = $con->prepare("SELECT email FROM users WHERE email = ?")) {
			$postEmail = $_POST['email'];
			$stmt->bind_param("s", $postEmail);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows>0) {
				setFlash("User already exists!", "error");
				redirect("../signup.php");
			} else {
			//Preparing statement to insert User into database
			$statement = $con->prepare("INSERT INTO users (role, username, email, password) VALUES(?, ?, ?, ?)");
			$statement->bind_param("isss", $this->role, $this->username, $this->email, $this->password);
			$statement->execute();
			$statement->close();
			setFlash("Login to proceed", "success");
			redirect("../login.php");
			
			}
		}
	}

}
$newUser = new Signup($_POST['username'], $_POST['password'], $_POST['email'], $_POST['role']);
$newUser->insertUser();
?>