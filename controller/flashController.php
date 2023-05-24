<?php 
 if(session_id() == ''){
      session_start();
   }
function setFlash($message, $type = null) {
	$_SESSION['flashMessage'] = $message;
	$_SESSION['type'] = $type;
}

function showFlash() {
	if(isset($_SESSION['flashMessage'])) {
		$type = isset($_SESSION['type']) ? $_SESSION['type'] : 'info';
		$flashMsg = $_SESSION['flashMessage'];
		$flashType = $_SESSION['type'];
		echo "<script>toastr.$flashType('$flashMsg');</script>";
      //now remove flashMessage & type from session
      unset($_SESSION['flashMessage']);
      unset($_SESSION['type']);
	  
		}
}