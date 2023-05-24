<?php 

	$host = "Localhost";
	$db_name = "okcl";
	$db_user = "root";
	$db_password = "";
	$base_url="http://localhost/okcl/";
	
	$con = mysqli_connect($host, $db_user, $db_password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  

?>