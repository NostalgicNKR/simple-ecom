<?php 

	$host = "";
	$db_name = "";
	$db_user = "";
	$db_password = "";
	$base_url="";
	
	$con = mysqli_connect($host, $db_user, $db_password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  

?>
